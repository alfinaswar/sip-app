<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public const CORE_PERMISSIONS = [
        'sip.view',
        'sip.create',
        'sip.edit',
        'sip.delete',
        'sip.export',
        'sip.import',
        'master-data.view',
        'master-data.manage',
        'user.manage',
        'role.manage',
    ];

    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        foreach (self::CORE_PERMISSIONS as $permissionName) {
            Permission::firstOrCreate([
                'name' => $permissionName,
                'guard_name' => 'web',
            ]);
        }

        $superAdmin = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'web',
        ]);
        $superAdmin->syncPermissions(Permission::where('guard_name', 'web')->pluck('name')->all());

        $operator = Role::firstOrCreate([
            'name' => 'Operator',
            'guard_name' => 'web',
        ]);
        $operator->syncPermissions([
            'sip.view',
            'sip.create',
            'sip.edit',
            'sip.delete',
            'sip.export',
            'sip.import',
            'master-data.view',
            'master-data.manage',
        ]);

        $viewer = Role::firstOrCreate([
            'name' => 'Viewer',
            'guard_name' => 'web',
        ]);
        $viewer->syncPermissions([
            'sip.view',
            'sip.export',
        ]);

        $adminUser = User::where('email', 'admin@gmail.com')->first() ?? User::orderBy('id')->first();
        if ($adminUser && !$adminUser->hasRole('Super Admin')) {
            $adminUser->assignRole($superAdmin);
        }

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
