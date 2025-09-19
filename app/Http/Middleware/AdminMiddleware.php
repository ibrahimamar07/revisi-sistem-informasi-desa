<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next,string $role): Response
    {
        $user = Auth::guard('pengguna')->user();
        //aman gaono masalah

        if (!$user) {
            return redirect()->route('loginpenduduk');
        }

        if ($user->role !== $role) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}