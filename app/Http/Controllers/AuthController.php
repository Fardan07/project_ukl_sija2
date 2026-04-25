<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // =====================
    // REGISTER
    // =====================
    public function register(Request $request)
    {
        // Validasi disederhanakan tanpa milih role dan no_guru
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        // Simpan langsung sebagai siswa (position_id 3)
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',        // Default role di set ke siswa
            'position_id' => 3,       // Default ID Jabatan Siswa
            'no_guru' => null,        // Siswa tidak punya nomor induk
        ]);

        return redirect()->route('login')->with('success','Akun berhasil dibuat!');
    }

    // =====================
    // LOGIN
    // =====================
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('landing');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    // =====================
    // LOGOUT
    // =====================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}