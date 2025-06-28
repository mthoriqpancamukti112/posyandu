<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('konten.auth.login');
    }

    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jika autentikasi berhasil
            if (Auth::user()->role == 'admin' || Auth::user()->role == 'bidan' || Auth::user()->role == 'ortu') {
                return redirect('/dashboard')->with('success', 'Selamat datang ' . Auth::user()->username);
            }
        }

        return back()->with('error', 'Periksa kembali email dan password anda');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil logout');
    }
}
