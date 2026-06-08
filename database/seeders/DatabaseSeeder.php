<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::create([
            'name' => 'Admin Helpdesk',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // SISWA
        User::create([
            'name' => 'Murid Test',
            'email' => 'murid@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'siswa',
            'class_id' => 1,
        ]);
    }
}