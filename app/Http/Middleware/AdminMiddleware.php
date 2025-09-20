<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next,...$role)
    {
        $user = Auth::guard('pengguna')->user();

        if (!$user || !in_array($user->role,$role)) {
            abort(403, 'Akses ditolak');
        }
        //aman gaono masalahh

        return $next($request);
    }
}