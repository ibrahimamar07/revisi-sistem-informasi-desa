<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepalaDesa extends Model
{
    use HasFactory;
    protected $table = 'kepaladesa';

    protected $fillable = [
        'nama_kades',
    ];

    public function suratKeluar()
    {
        return $this->hasMany(SuratKeluar::class, 'nama_kades');
    }
    
    
}
