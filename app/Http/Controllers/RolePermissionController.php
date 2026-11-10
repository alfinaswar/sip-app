<?php

namespace App\Http\Controllers;

use Database\Seeders\RolePermissionSeeder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'permission:role.manage']);
    }

    public function rolesIndex(Request $request)
    {
        $roles = Role::with('permissions')->withCount('users')
            ->where('guard_name', 'web')
            ->orderBy('id')
            ->get();

        $permissions = Permission::where('guard_name', 'web')->orderBy('name')->get();
        $permissionGroups = $this->groupPermissions($permissions);
        $editRole = $request->filled('edit') ? Role::with('permissions')->find($request->edit) : null;

        return view('access.roles.index', [
            'roles' => $roles,
            'permissionGroups' => $permissionGroups,
            'editRole' => $editRole,
            'totalPermissions' => $permissions->count(),
        ]);
    }

    public function storeRole(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('roles', 'name')->where('guard_name', 'web')],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string', Rule::exists('permissions', 'name')->where('guard_name', 'web')],
        ], $this->messages(), $this->attributes());

        $role = Role::create([
            'name' => trim($validated['name']),
            'guard_name' => 'web',
        ]);

        $role->syncPermissions($validated['permissions'] ?? []);
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()->route('access.roles.index')
            ->with('success', 'Role "' . $role->name . '" berhasil dibuat.');
    }

    public function updateRole(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('roles', 'name')->where('guard_name', 'web')->ignore($role->id)],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string', Rule::exists('permissions', 'name')->where('guard_name', 'web')],
        ], $this->messages(), $this->attributes());

        $newName = trim($validated['name']);
        if ($role->name === 'Super Admin' && $newName !== 'Super Admin') {
            return back()->withInput()->with('error', 'Nama role Super Admin bawaan sistem tidak dapat diubah.');
        }

        $role->update(['name' => $newName]);

        if ($role->name === 'Super Admin') {
            $role->syncPermissions(Permission::where('guard_name', 'web')->pluck('name')->all());
        } else {
            $role->syncPermissions($validated['permissions'] ?? []);
        }

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()->route('access.roles.index')
            ->with('success', 'Role "' . $role->name . '" dan hak akses berhasil diperbarui.');
    }

    public function destroyRole(Role $role)
    {
        if ($role->name === 'Super Admin') {
            return redirect()->route('access.roles.index')
                ->with('error', 'Role Super Admin bawaan sistem tidak dapat dihapus.');
        }

        $usersCount = $role->users()->count();
        if ($usersCount > 0) {
            return redirect()->route('access.roles.index')
                ->with('error', 'Role "' . $role->name . '" masih digunakan oleh ' . $usersCount . ' pengguna.');
        }

        $name = $role->name;
        $role->delete();
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()->route('access.roles.index')
            ->with('success', 'Role "' . $name . '" berhasil dihapus.');
    }

    public function permissionsIndex(Request $request)
    {
        $permissions = Permission::with('roles')
            ->where('guard_name', 'web')
            ->orderBy('name')
            ->get();

        $editPermission = $request->filled('edit') ? Permission::find($request->edit) : null;

        return view('access.permissions.index', [
            'permissions' => $permissions,
            'editPermission' => $editPermission,
            'corePermissions' => RolePermissionSeeder::CORE_PERMISSIONS,
            'totalRoles' => Role::where('guard_name', 'web')->count(),
        ]);
    }

    public function storePermission(Request $request)
    {
        $request->merge(['name' => strtolower(trim((string) $request->input('name')))]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'regex:/^[a-z0-9._-]+$/', Rule::unique('permissions', 'name')->where('guard_name', 'web')],
        ], $this->messages(), $this->attributes());

        $permission = Permission::create([
            'name' => $validated['name'],
            'guard_name' => 'web',
        ]);

        $superAdmin = Role::where('name', 'Super Admin')->where('guard_name', 'web')->first();
        if ($superAdmin) {
            $superAdmin->givePermissionTo($permission);
        }

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()->route('access.permissions.index')
            ->with('success', 'Permission "' . $permission->name . '" berhasil ditambahkan.');
    }

    public function updatePermission(Request $request, Permission $permission)
    {
        $request->merge(['name' => strtolower(trim((string) $request->input('name')))]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'regex:/^[a-z0-9._-]+$/', Rule::unique('permissions', 'name')->where('guard_name', 'web')->ignore($permission->id)],
        ], $this->messages(), $this->attributes());

        if (in_array($permission->name, RolePermissionSeeder::CORE_PERMISSIONS, true) && $validated['name'] !== $permission->name) {
            return back()->withInput()
                ->with('error', 'Nama permission bawaan sistem tidak dapat diubah karena terhubung dengan hak akses modul.');
        }

        $permission->update(['name' => $validated['name']]);
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()->route('access.permissions.index')
            ->with('success', 'Permission "' . $permission->name . '" berhasil diperbarui.');
    }

    public function destroyPermission(Permission $permission)
    {
        if (in_array($permission->name, RolePermissionSeeder::CORE_PERMISSIONS, true)) {
            return redirect()->route('access.permissions.index')
                ->with('error', 'Permission bawaan sistem tidak dapat dihapus.');
        }

        $name = $permission->name;
        $permission->delete();
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()->route('access.permissions.index')
            ->with('success', 'Permission "' . $name . '" berhasil dihapus.');
    }

    private function groupPermissions($permissions): array
    {
        $groups = [
            'SIP Rumah Dinas' => [],
            'Data Master' => [],
            'Manajemen Akses' => [],
            'Permission Tambahan' => [],
        ];

        foreach ($permissions as $permission) {
            if (str_starts_with($permission->name, 'sip.')) {
                $groups['SIP Rumah Dinas'][] = $permission;
            } elseif (str_starts_with($permission->name, 'master-data.')) {
                $groups['Data Master'][] = $permission;
            } elseif (str_starts_with($permission->name, 'user.') || str_starts_with($permission->name, 'role.')) {
                $groups['Manajemen Akses'][] = $permission;
            } else {
                $groups['Permission Tambahan'][] = $permission;
            }
        }

        return array_filter($groups);
    }

    private function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'unique' => ':attribute sudah terdaftar.',
            'max' => ':attribute maksimal :max karakter.',
            'regex' => ':attribute hanya boleh berisi huruf kecil, angka, titik (.), strip (-), atau garis bawah (_).',
            'exists' => ':attribute yang dipilih tidak valid.',
        ];
    }

    private function attributes(): array
    {
        return [
            'name' => 'Nama',
            'permissions' => 'Permission',
        ];
    }
}
