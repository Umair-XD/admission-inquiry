<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Seeding roles & permissions...');
        $this->call(RolePermissionSeeder::class);

        $this->command->info('Seeding super admin user...');
        $this->call(SuperAdminSeeder::class);

        $this->command->info('Seeding degrees...');
        $this->call(DegreeSeeder::class);
    }
}
