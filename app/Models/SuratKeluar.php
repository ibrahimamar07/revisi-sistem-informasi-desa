<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $table = 'surat_keluar';

    protected $fillable = [

         'no_surat','tanggal', 'pengirim', 'perihal_surat_id', 'path', 'created_by','status', 'nama_kades'
 
    ];
    protected $casts = [
        'tanggal' => 'date',
    ];


    // Relasi ke perihal_surat
    public function perihal()
    {
        return $this->belongsTo(PerihalSurat::class, 'perihal_surat_id');
    }


    public function noSurat(){
        return $this->belongsTo(PerihalSurat::class,'no_surat','id');
    }

    public function kepalaDesa()

    // Relasi ke user yang membuat surat
    
    {
        return $this->belongsTo(KepalaDesa::class, 'nama_kades');
    }

    public function isNull(){
        return $this -> nama_kades ===nulll;
    }

    

    // public function creator()
    // {
    //     return $this->belongsTo(User::class, 'created_by');
    // }

     public function creator()
    {
        return $this->belongsTo(Pengguna::class, 'created_by');
    }
}