<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:pengguna');
        // $this->middleware('admin');
    }

    public function show()
    {
        $user = Auth::guard('pengguna')->user();
        return view('user.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('pengguna')->user();
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pengguna,email,' . $user->id,
            'nomor_hp' => 'required|string|max:15',
            'alamat_tanggallahir' => 'required|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->nomor_hp = $request->nomor_hp;
        $user->alamat_tanggallahir = $request->alamat_tanggallahir;
        
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui.');
        
    }
}