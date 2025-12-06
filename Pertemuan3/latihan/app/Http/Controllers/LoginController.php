<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    
    public function showLoginForm() {
        return view('login');
    }

    public function login(Request $request) {
        // Validasi input
        $request -> validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Logic login dengan auth:attempt
        if(Auth::attempt($request->only('email', 'password'))) {
            // Jika login berhasil, redirect ke halaman utama
            $request->session()->regenerate();
            return redirect()->intended('/posts');
        }

        // Jika login gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}
