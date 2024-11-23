<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Cek apakah pengguna sudah login dan memiliki role yang benar
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Jika tidak sesuai, arahkan kembali ke halaman sebelumnya atau halaman lain
        return redirect('/login')->withErrors('Anda tidak memiliki akses ke halaman ini.');
    }
}
