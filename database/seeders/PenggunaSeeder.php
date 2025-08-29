<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;
use App\Models\Penduduk;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        // Create Admin User
        Pengguna::create([
            'nama' => 'Administrator',
            'email' => 'admin@desagumawangrejo.id',
            'nomor_hp' => '081234567890',
            'alamat_tanggallahir' => 'Desa Gumawangrejo, Lamongan, 15 Januari 1980',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create Non-Admin User
        Pengguna::create([
            'nama' => 'Warga',
            'email' => 'warga@desagumawangrejo.id',
            'nomor_hp' => '081234567891',
            'alamat_tanggallahir' => 'Desa Gumawangrejo, Lamongan, 20 Mei 1985',
            'password' => Hash::make('Warga123'),
            'role' => 'nonadmin',
        ]);
    }
}
