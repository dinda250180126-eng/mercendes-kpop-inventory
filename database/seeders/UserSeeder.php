<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        User::create([
            'name' => 'Admin Kpopmerch',
            'email' => 'admin@kpopmerch.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. Akun Customer
        User::create([
            'name' => 'Customer Kpopmerch',
            'email' => 'customer@kpopmerch.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
        ]);

        // 3. Akun Staff
        User::create([
            'name' => 'Staff Kpopmerch',
            'email' => 'staff@kpopmerch.com',
            'password' => Hash::make('password123'),
            'role' => 'staff',
        ]);
    }
}