<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;

class AuthNewController extends Controller
{
    
    public function showLogin()
{
    if (Auth::guard('pengguna')->check()) {
        return redirect('/dashboard');
    }
    return view('authnew.login');
}

    public function login(Request $request)
    {
         
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'nik'=>[],
            'password' => ['required'],
        ]);
        

        if (Auth::guard('pengguna')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email ,Nik atau password salah.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('authnew.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:pengguna'],
            'nomor_hp' => ['required', 'string', 'max:15'],
            'nik'=> ['required','string','max:16','unique:pengguna'],
            'alamat_tanggallahir' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $pengguna = Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_hp' => $request->nomor_hp,
            'nik'=>$request->nik,
            'alamat_tanggallahir' => $request->alamat_tanggallahir,
            'password' => Hash::make($request->password),
            'role' => 'nonadmin', // Default role
        ]);

        Auth::guard('pengguna')->login($pengguna);

        return redirect('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('pengguna')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/loginpenduduk');
    }
}