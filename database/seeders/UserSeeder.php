<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin PPTK
        User::create([
            'name' => 'favian astama',
            'username' => 'Admin PPTK',
            'password' => 'admin123',
            'role' => 'admin_pptk',
        ]);

        // Tenaga Pendidik
        User::create([
            'name' => 'cristiano ronaldo',
            'username' => 'Tenaga Pendidik 1',
            'password' => 'pendidik123',
            'role' => 'tenaga_pendidik',
        ]);

        User::create([
            'name' => 'hala madrid',
            'username' => 'Tenaga Pendidik 2',
            'password' => 'pendidik123',
            'role' => 'tenaga_pendidik',
        ]);
    }
}