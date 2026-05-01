<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        // Buat Akun Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@koperasi.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Buat Akun Customer Contoh
        User::create([
            'name' => 'Kevin Customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
        ]);

        // Buat Kategori Contoh
        Category::create(['name' => 'Kaus', 'slug' => 'kaus']);
        Category::create(['name' => 'Jaket', 'slug' => 'jaket']);
    }
}