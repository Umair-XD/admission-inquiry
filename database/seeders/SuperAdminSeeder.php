<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'admin@admission.app'],
            [
                'name' => 'Super Admin',
                'email' => 'admin@admission.app',
                'password' => Hash::make('admin@123'),
                'role' => RoleEnum::SUPER_ADMIN,
            ]
        );

        // Assign the Spatie role
        $user->syncRoles([RoleEnum::SUPER_ADMIN]);

        $this->command->info('Super Admin seeded: admin@admission.app / admin@123');
    }
}
