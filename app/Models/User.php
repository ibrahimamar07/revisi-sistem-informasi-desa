<?php
// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function suratMasuk()
    {
        return $this->hasMany(SuratMasuk::class, 'created_by');
    }

    // public function suratKeluar()
    // {
    //     return $this->hasMany(SuratKeluar::class, 'created_by');
    // }

    public function isAdminPPTK()
    {
        return $this->role === 'admin_pptk';
    }

    public function isTenagaPendidik()
    {
        return $this->role === 'tenaga_pendidik';
    }
}