<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PerihalSurat;

class PerihalSuratSeeder extends Seeder
{
    public function run(): void
    {
        $perihalSurat = [
            'Undangan Rapat Koordinasi',
            'Pemberitahuan Kegiatan Sekolah',
            'Permohonan Izin Kegiatan',
            'Laporan Kegiatan Pendidikan',
            'Surat Edaran Kebijakan',
            'Undangan Workshop/Pelatihan',
            'Permohonan Dana Kegiatan',
            'Laporan Keuangan',
            'Surat Tugas',
            'Pemberitahuan Jadwal Ujian',
        ];

        foreach ($perihalSurat as $deskripsi) {
            PerihalSurat::create([
                'deskripsi' => $deskripsi
            ]);
        }
    }
}
