<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@kpopmerch.com'],
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('password123'),
                'role' => 'admin'
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@kpopmerch.com'],
            [
                'name' => 'Staff Gudang',
                'password' => Hash::make('password123'),
                'role' => 'staff'
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer@kpopmerch.com'],
            [
                'name' => 'Customer Pembeli',
                'password' => Hash::make('password123'),
                'role' => 'customer'
            ]
        );
    }
}