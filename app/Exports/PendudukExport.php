<?php

namespace App\Exports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PendudukExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Penduduk::select('nik','no_kk', 'nama', 'jenis_kelamin', 'agama', 'alamat_tanggallahir')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'NIK',
            'No KK',
            'Nama',
            'Jenis Kelamin',
            'Agama',
            'Alamat_tanggallahir',
        ];
    }
}