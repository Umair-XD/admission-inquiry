<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Clear cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            'view dashboard',
            'create posts',
            'edit posts',
            'delete posts',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create Roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole  = Role::create(['name' => 'user']);

        // Assign Permissions
        $adminRole->givePermissionTo(Permission::all());
        $userRole->givePermissionTo(['view dashboard']);
    }
}