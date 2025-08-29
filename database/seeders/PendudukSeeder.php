<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;
use App\Models\Penduduk;

class PendudukSeeder extends Seeder
{
    public function run()
    {
        // Sample Penduduk Data
        $pendudukData = [
            [
                'nik' => '3524010101800001',
                'nama' => 'Ahmad Suryadi',
                'alamat_tanggallahir' => 'Jl. Merdeka No. 10, RT 01/RW 01, Desa Gumawangrejo, Lamongan, 1 Januari 1980',
                'jenis_kelamin' => 'L',
                'agama' => 'Islam'
            ],
            [
                'nik' => '3524010202850002',
                'nama' => 'Siti Nurhaliza',
                'alamat_tanggallahir' => 'Jl. Pancasila No. 15, RT 02/RW 01, Desa Gumawangrejo, Lamongan, 2 Februari 1985',
                'jenis_kelamin' => 'P',
                'agama' => 'Islam'
            ],
            [
                'nik' => '3524010303900003',
                'nama' => 'Budi Santoso',
                'alamat_tanggallahir' => 'Jl. Diponegoro No. 20, RT 03/RW 01, Desa Gumawangrejo, Lamongan, 3 Maret 1990',
                'jenis_kelamin' => 'L',
                'agama' => 'Kristen'
            ],
            [
                'nik' => '3524010404920004',
                'nama' => 'Dewi Sartika',
                'alamat_tanggallahir' => 'Jl. Sudirman No. 25, RT 04/RW 02, Desa Gumawangrejo, Lamongan, 4 April 1992',
                'jenis_kelamin' => 'P',
                'agama' => 'Islam'
            ],
            [
                'nik' => '3524010505880005',
                'nama' => 'Eko Prasetyo',
                'alamat_tanggallahir' => 'Jl. Gatot Subroto No. 30, RT 01/RW 02, Desa Gumawangrejo, Lamongan, 5 Mei 1988',
                'jenis_kelamin' => 'L',
                'agama' => 'Islam'
            ],
            [
                'nik' => '3524010606950006',
                'nama' => 'Fitri Handayani',
                'alamat_tanggallahir' => 'Jl. Ahmad Yani No. 35, RT 02/RW 02, Desa Gumawangrejo, Lamongan, 6 Juni 1995',
                'jenis_kelamin' => 'P',
                'agama' => 'Islam'
            ],
            [
                'nik' => '3524010707850007',
                'nama' => 'Gunawan Wijaya',
                'alamat_tanggallahir' => 'Jl. Kartini No. 40, RT 03/RW 02, Desa Gumawangrejo, Lamongan, 7 Juli 1985',
                'jenis_kelamin' => 'L',
                'agama' => 'Katolik'
            ],
            [
                'nik' => '3524010808900008',
                'nama' => 'Hani Rahmawati',
                'alamat_tanggallahir' => 'Jl. Cut Nyak Dien No. 45, RT 04/RW 03, Desa Gumawangrejo, Lamongan, 8 Agustus 1990',
                'jenis_kelamin' => 'P',
                'agama' => 'Islam'
            ]
        ];

        foreach ($pendudukData as $data) {
            Penduduk::create($data);
        }
    }
}