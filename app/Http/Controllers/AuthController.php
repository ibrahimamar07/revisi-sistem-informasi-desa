<?php
// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return $user->isAdminPPTK()
                ? redirect()->route('admin.dashboard')
                : redirect()->route('tenaga-pendidik.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);


        $user = User::where('username', $request->username)->first();

        if ($user && $user->password === $request->password) {
            Auth::login($user);
            $request->session()->regenerate();

            if ($user->isAdminPPTK()) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('tenaga-pendidik.dashboard');
            }
        }


        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('name');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
    //tes
}