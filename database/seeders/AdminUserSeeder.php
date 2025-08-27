<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user if it doesn't exist
        User::firstOrCreate(
            ['email' => 'abdelrahmanyouseff@gmail.com'],
            [
                'name' => 'Abdelrahman Youseff',
                'email' => 'abdelrahmanyouseff@gmail.com',
                'password' => Hash::make('V@ntom2121992'),
                'email_verified_at' => now(),
            ]
        );

        // Also ensure the original admin user exists
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
    }
}



