<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::firstOrCreate([
            'email' => 'admin@example.com'
        ], [
            'name' => 'Sofian Gamal',
            'phone' => '+201234567890',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);

        User::firstOrCreate([
            'email' => 'user@example.com'
        ], [
            'name' => 'Mohamed Ali',
            'phone' => '+201234567891',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'role' => 'user',
        ]);
    }
}