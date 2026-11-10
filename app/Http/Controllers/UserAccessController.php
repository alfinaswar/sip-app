<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserAccessController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'permission:user.manage']);
    }

    public function index(Request $request)
    {
        $users = User::with(['roles', 'permissions'])->orderBy('id')->get();
        $roles = Role::where('guard_name', 'web')->orderBy('id')->get();
        $permissions = Permission::where('guard_name', 'web')->orderBy('name')->get();
        $editUser = $request->filled('edit') ? User::with(['roles', 'permissions'])->find($request->edit) : null;

        return view('access.users.index', compact('users', 'roles', 'permissions', 'editUser'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['string', Rule::exists('roles', 'name')->where('guard_name', 'web')],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string', Rule::exists('permissions', 'name')->where('guard_name', 'web')],
        ], $this->messages(), $this->attributes());

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->syncRoles($validated['roles'] ?? []);
        $user->syncPermissions($validated['permissions'] ?? []);
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()->route('access.users.index')
            ->with('success', 'Pengguna "' . $user->name . '" berhasil ditambahkan.');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['string', Rule::exists('roles', 'name')->where('guard_name', 'web')],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string', Rule::exists('permissions', 'name')->where('guard_name', 'web')],
        ], $this->messages(), $this->attributes());

        $newRoles = $validated['roles'] ?? [];
        $wasSuperAdmin = $user->hasRole('Super Admin');
        $staysSuperAdmin = in_array('Super Admin', $newRoles, true);

        if ($wasSuperAdmin && !$staysSuperAdmin) {
            if ($user->id === $request->user()->id) {
                return back()->withInput()->with('error', 'Anda tidak dapat mencabut role Super Admin dari akun Anda sendiri.');
            }
            if (User::role('Super Admin')->count() <= 1) {
                return back()->withInput()->with('error', 'Minimal harus terdapat satu akun dengan role Super Admin.');
            }
        }

        $payload = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];
        if (!empty($validated['password'])) {
            $payload['password'] = Hash::make($validated['password']);
        }

        $user->update($payload);
        $user->syncRoles($newRoles);
        $user->syncPermissions($validated['permissions'] ?? []);
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()->route('access.users.index')
            ->with('success', 'Data pengguna "' . $user->name . '" berhasil diperbarui.');
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->id === $request->user()->id) {
            return redirect()->route('access.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun yang sedang digunakan.');
        }

        if ($user->hasRole('Super Admin') && User::role('Super Admin')->count() <= 1) {
            return redirect()->route('access.users.index')
                ->with('error', 'Akun Super Admin terakhir tidak dapat dihapus.');
        }

        $name = $user->name;
        $user->delete();
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return redirect()->route('access.users.index')
            ->with('success', 'Pengguna "' . $name . '" berhasil dihapus.');
    }

    private function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'email' => ':attribute harus berupa alamat email yang valid.',
            'unique' => ':attribute sudah terdaftar.',
            'min' => ':attribute minimal :min karakter.',
            'max' => ':attribute maksimal :max karakter.',
            'confirmed' => 'Konfirmasi :attribute tidak cocok.',
            'exists' => ':attribute yang dipilih tidak valid.',
        ];
    }

    private function attributes(): array
    {
        return [
            'name' => 'Nama Lengkap',
            'email' => 'Email',
            'password' => 'Kata Sandi',
            'roles' => 'Role',
            'permissions' => 'Permission',
        ];
    }
}
