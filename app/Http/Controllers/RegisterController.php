<?php

namespace App\Http\Controllers;

use App\Models\OrangTua;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('konten.auth.register');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'nullable',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
            'nik' => 'required|unique:orangtua,nik|max:16',
            'nama_ortu' => 'required|max:255',
            'tgl_lahir' => 'required|date',
            'no_hp' => 'required|between:10,13',
        ], [
            'nik.required' => 'NIK tidak boleh kosong.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nik.max' => 'NIK tidak boleh lebih dari :max karakter.',
            'nama_ortu.required' => 'Nama orang tua tidak boleh kosong.',
            'nama_ortu.max' => 'Nama orang tua tidak boleh lebih dari :max karakter.',
            'tgl_lahir.required' => 'Tanggal lahir tidak boleh kosong.',
            'tgl_lahir.date' => 'Format tanggal lahir tidak valid.',
            'no_hp.required' => 'Nomor HP tidak boleh kosong.',
            'no_hp.between' => 'Nomor HP harus antara :min dan :max karakter.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari :max karakter.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.min' => 'Password harus terdiri dari minimal :min karakter.',
        ]);

        $orangtua = OrangTua::create([
            'nik' => $data['nik'],
            'nama_ortu' => $data['nama_ortu'],
            'tgl_lahir' => $data['tgl_lahir'],
            'no_hp' => $data['no_hp'],
        ]);

        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'ortu',
            'orangtua_id' => $orangtua->id,
        ]);

        return redirect()->route('login.index')->with('success', 'Berhasil registrasi, silahkan login.');
    }
}
