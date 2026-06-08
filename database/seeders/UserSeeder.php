<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $admin->assignRole('admin');

        // Create Normal User
        $user = User::create([
            'name' => 'Normal User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $user->assignRole('user');
    }
}