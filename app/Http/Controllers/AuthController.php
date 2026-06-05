<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi input form (menangkap 'username' dari blade)
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginInput = $request->input('username');
        $password = $request->input('password');

        // 2. Trik Utama: Cari user di database lewat kolom 'name' ATAU 'email'
        // Jadi kalau murid input nama lengkap/username MyLMS-nya, Laravel bisa nemu email aslinya
        $user = User::where('name', $loginInput)
                    ->orWhere('email', $loginInput)
                    ->first();

        // 3. Jika user ditemukan, lakukan proses autentikasi menggunakan EMAIL asli mereka
        if ($user) {
            $credentials = [
                'email'    => $user->email, // Tetap lempar email asli ke Laravel Auth
                'password' => $password
            ];

            if (Auth::attempt($credentials, $request->filled('remember'))) {
                $request->session()->regenerate();

                // Redirect sesuai role masing-masing
                if ($user->role === 'admin') {
                    return redirect()->intended('/admin/dashboard')->with('success', 'Selamat datang Admin!');
                } elseif ($user->role === 'guru') {
                    return redirect()->intended('/guru/dashboard');
                } else {
                    return redirect()->intended('/dashboard'); // Dashboard Murid
                }
            }
        }

        // 4. Jika gagal, kembalikan dengan pesan error
        return back()->withErrors([
            'username' => 'Username atau Password MyLMS salah / tidak terdaftar.',
        ])->withInput($request->only('username', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}