<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $table = 'surat_keluar';

    protected $fillable = [
        'no_surat',
        'perihal_surat_id',
        'nama',
        'nik',
        'ttl',
        'jk',
        'pekerjaan',
        'agama',
        'alamat',
        'path',
        'created_by'
    ];
    protected $casts = [
        'tanggal' => 'date',
    ];


    // Relasi ke perihal_surat
    public function perihal()
    {
        return $this->belongsTo(PerihalSurat::class, 'perihal_surat_id');
    }

    // Relasi ke user yang membuat surat
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}