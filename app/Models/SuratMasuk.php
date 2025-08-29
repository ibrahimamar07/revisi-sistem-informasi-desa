<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';

    protected $fillable = [
        'no_surat', 'tanggal', 'perihal_surat_id', 'path', 'created_by'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function perihalSurat()
    {
        return $this->belongsTo(PerihalSurat::class, 'perihal_surat_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getFileNameAttribute()
    {
        return basename($this->path);
    }

    public function getFileUrlAttribute()
    {
        return Storage::url($this->path);
    }

    public function getFileSizeAttribute()
    {
        if (Storage::exists($this->path)) {
            return Storage::size($this->path);
        }
        return 0;
    }

    public function getFormattedFileSizeAttribute()
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }
}