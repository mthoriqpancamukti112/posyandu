<?php

namespace App\Http\Controllers;

use App\Models\OrangTua;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OrangTuaController extends Controller
{
    public function index()
    {
        $orangtua = OrangTua::with('balitas', 'user')->orderBy('nama_ortu', 'asc')->get();
        return view('admin.orangtua.index', compact('orangtua'));
    }

    public function create()
    {
        return view('admin.orangtua.create');
    }

    public function edit($id)
    {
        $orangtua = OrangTua::with('user')->findOrFail($id);
        return view('admin.orangtua.edit', compact('orangtua'));
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
            'nik.unique' => 'NIK sudah ada.',
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

        return redirect()->route('orangtua.index')->with('success', 'Data orang tua berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        // Mendapatkan instance orang tua berdasarkan ID
        $orangtua = OrangTua::findOrFail($id);

        $data = $request->validate([
            'nik' => 'required|max:16',
            'nama_ortu' => 'required|max:255',
            'tgl_lahir' => 'required|date',
            'no_hp' => 'required|between:10,13',
            'email' => 'required|email|max:255',
            'username' => 'nullable',
            'password' => 'nullable|sometimes|min:6',
        ], [
            'nik.required' => 'NIK tidak boleh kosong.',
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
            'password.min' => 'Password harus terdiri dari minimal :min karakter.',
        ]);

        $orangtua->update([
            'nik' => $data['nik'],
            'nama_ortu' => $data['nama_ortu'],
            'tgl_lahir' => $data['tgl_lahir'],
            'no_hp' => $data['no_hp'],
        ]);

        // Perbarui data user
        $user = $orangtua->user; // Mengambil user
        if ($user) {
            $user->update([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);
        }

        return redirect()->route('orangtua.index')->with('success', 'Data orang tua berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $orangtua = OrangTua::findOrFail($id);
        $orangtua->delete();
        return redirect()->route('orangtua.index')->with('success', 'Data orang tua berhasil dihapus.');
    }
}