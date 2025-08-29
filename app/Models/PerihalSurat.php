<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerihalSurat extends Model
{
    use HasFactory;

    protected $table = 'perihal_surat';
    
    protected $fillable = [
        'deskripsi'
    ];

    public function suratMasuk()
    {
        return $this->hasMany(SuratMasuk::class, 'perihal_surat_id');
    }

    public function suratKeluar()
    {
        return $this->hasMany(SuratKeluar::class, 'perihal_surat_id');
    }
}