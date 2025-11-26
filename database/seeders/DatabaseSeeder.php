<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Menu;
use App\Models\LokasiCafe;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        // Buat beberapa menu contoh
        Menu::create([
            'nama_menu' => 'Espresso',
            'kategori' => 'Kopi',
            'harga' => 15000,
            'deskripsi' => 'Kopi espresso klasik',
            'status' => 'tersedia',
        ]);

        Menu::create([
            'nama_menu' => 'Green Tea Latte',
            'kategori' => 'Non Kopi',
            'harga' => 22000,
            'deskripsi' => 'Teh hijau dengan susu',
            'status' => 'tersedia',
        ]);

        Menu::create([
            'nama_menu' => 'Lemon Squash',
            'kategori' => 'Squash',
            'harga' => 18000,
            'deskripsi' => 'Minuman segar lemon',
            'status' => 'tersedia',
        ]);

        // Buat data lokasi cafe
        LokasiCafe::create([
            'nama_cafe' => 'Kedai',
            'alamat' => 'Jl. Raya',
            'latitude' => -7.265757,
            'longitude' => 112.734146,
            'deskripsi' => 'nyaman',
        ]);
    }
}