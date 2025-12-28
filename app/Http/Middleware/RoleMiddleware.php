<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles (Variadic parameter untuk menerima banyak role)
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Ambil jabatan user saat ini
        $jabatan = Auth::user()->jabatan;

        // 3. Cek apakah jabatan user ada dalam daftar role yang diizinkan
        if (in_array($jabatan, $roles)) {
            return $next($request);
        }

        // 4. Jika tidak memiliki akses, arahkan ke 403 Forbidden
        abort(403, 'Maaf, jabatan Anda (' . $jabatan . ') tidak memiliki akses ke halaman ini.');
    }
}