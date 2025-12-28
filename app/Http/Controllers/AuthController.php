<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'nama_pegawai' => ['required'],
            'password' => ['required'],
        ]);

        // Attempt login menggunakan guard default (yang sudah kita arahkan ke model Pegawai)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Logika Redirect berdasarkan Role (Persyaratan UAS)
            $user = Auth::user();
            if ($user->jabatan === 'admin') {
                return redirect()->intended('/dashboard');
            } else {
                return redirect()->intended('/penjualan/create');
            }
        }

        return back()->withErrors([
            'nama_pegawai' => 'Kredensial yang diberikan tidak cocok dengan data kami.',
        ])->onlyInput('nama_pegawai');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}