<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Clear Spatie permission cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Create all permissions
        foreach (PermissionEnum::all() as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => 'web']);
        }

        // 2. Create all roles from RoleEnum
        foreach (RoleEnum::getValues() as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }

        // 3. Assign all permissions to super_admin only
        $superAdmin = Role::firstOrCreate([
            'name' => RoleEnum::SUPER_ADMIN,
            'guard_name' => 'web',
        ]);

        // 4. Sync all permissions to super_admin
        $superAdmin->syncPermissions(PermissionEnum::superAdminPermissions());

        $this->command->info('Roles and permissions seeded successfully.');
    }
}
