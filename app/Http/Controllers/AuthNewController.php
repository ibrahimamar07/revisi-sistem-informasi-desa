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
        return redirect('/portal');
    }
    return view('authnew.login');
}
    public function showportal()
    {
        
        return view('portal.portal');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            // 'nik' => ['nullable', 'string', 'max:16'],
            'no_kk' => ['nullable', 'string', 'max:16'],
        ]);

        $user = Pengguna::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan.',
            ]);
        }

        // Untuk warga, nik wajib diisi dan harus cocok
        if ($user->role === 'warga') {
            if (empty($credentials['no_kk']) || $user->no_kk !== $credentials['no_kk']) {
                return back()->withErrors([
                    'no_kk' => 'No KK  wajib diisi dan harus sesuai',
                ]);
            }
        }

        // Untuk role lain, nik boleh kosong
        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'password' => 'Password salah.',
            ]);
        }

        Auth::guard('pengguna')->login($user);
        $request->session()->regenerate();
        return redirect()->intended('/portal');
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
             'no_kk'=> ['required','string','max:16'],
            'alamat_tanggallahir' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $pengguna = Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_hp' => $request->nomor_hp,
            'nik'=>$request->nik,
            'no_kk'=>$request->no_kk,
            'alamat_tanggallahir' => $request->alamat_tanggallahir,
            'password' => Hash::make($request->password),
            'role' => 'warga', // Default role
        ]);

        Auth::guard('pengguna')->login($pengguna);

        return redirect('/portal');
    }

    public function logout(Request $request)
    {
        Auth::guard('pengguna')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/loginpenduduk');
    }
}
