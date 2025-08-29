<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Config;

class SetPendudukSession
{
    public function handle($request, Closure $next)
    {
        Config::set('session.cookie', 'penduduk_session');
        return $next($request);
    }
}
