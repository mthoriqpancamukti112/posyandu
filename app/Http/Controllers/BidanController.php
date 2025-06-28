<?php

namespace App\Http\Controllers;

use App\Models\Bidan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BidanController extends Controller
{
    public function index()
    {
        $bidan = Bidan::with('user')->orderBy('nama_bidan', 'asc')->get();
        return view('admin.bidan.index', compact('bidan'));
    }

    public function create()
    {
        return view('admin.bidan.create');
    }

    public function edit($id)
    {
        $bidan = Bidan::with('user')->findOrFail($id);
        return view('admin.bidan.edit', compact('bidan'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $data = $request->validate([
            'username' => 'required|max:50',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
            'nik' => 'required|unique:bidan,nik|max:16',
            'nip' => 'required|unique:bidan,nip|max:18',
            'nama_bidan' => 'required|max:255',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required',
            'no_hp' => 'required|between:10,13',
        ], [
            'username.required' => 'Nama panggilan tidak boleh kosong.',
            'username.max' => 'Nama panggilan tidak boleh lebih dari :max karakter.',
            'nik.required' => 'NIK tidak boleh kosong.',
            'nik.unique' => 'NIK sudah ada.',
            'nik.max' => 'NIK tidak boleh lebih dari :max karakter.',
            'nip.required' => 'NIP tidak boleh kosong.',
            'nip.unique' => 'NIP sudah ada.',
            'nip.max' => 'NIP tidak boleh lebih dari :max karakter.',
            'nama_bidan.required' => 'Nama bidan tidak boleh kosong.',
            'nama_bidan.max' => 'Nama bidan tidak boleh lebih dari :max karakter.',
            'tgl_lahir.required' => 'Tanggal lahir tidak boleh kosong.',
            'tgl_lahir.date' => 'Format tanggal lahir tidak valid.',
            'alamat.required' => 'Alamat tidak boleh kosong.',
            'no_hp.required' => 'Nomor HP tidak boleh kosong.',
            'no_hp.between' => 'Nomor HP harus antara :min dan :max karakter.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari :max karakter.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.min' => 'Password harus terdiri dari minimal :min karakter.',
        ]);

        $bidan = Bidan::create([
            'nik' => $data['nik'],
            'nip' => $data['nip'],
            'nama_bidan' => $data['nama_bidan'],
            'tgl_lahir' => $data['tgl_lahir'],
            'alamat' => $data['alamat'],
            'no_hp' => $data['no_hp'],
        ]);

        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'bidan',
            'bidan_id' => $bidan->id,
        ]);

        return redirect()->route('bidan.index')->with('success', 'Data bidan berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        // Mendapatkan instance orang tua berdasarkan ID
        $bidan = Bidan::findOrFail($id);

        // Validasi data yang diterima dari request
        $data = $request->validate([
            'nik' => 'required|max:16',
            'nip' => 'required|max:18',
            'nama_bidan' => 'required|max:255',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required',
            'no_hp' => 'required|between:10,13',
            'email' => 'required|email|max:255',
            'username' => 'required|max:50',
            'password' => 'nullable|sometimes|min:6',
        ], [
            'nik.required' => 'NIK tidak boleh kosong.',
            'nik.max' => 'NIK tidak boleh lebih dari :max karakter.',
            'nip.required' => 'NIP tidak boleh kosong.',
            'nip.max' => 'NIP tidak boleh lebih dari :max karakter.',
            'nama_bidan.required' => 'Nama bidan tidak boleh kosong.',
            'nama_bidan.max' => 'Nama bidan tidak boleh lebih dari :max karakter.',
            'tgl_lahir.required' => 'Tanggal lahir tidak boleh kosong.',
            'tgl_lahir.date' => 'Format tanggal lahir tidak valid.',
            'alamat.required' => 'Alamat tidak boleh kosong.',
            'no_hp.required' => 'Nomor HP tidak boleh kosong.',
            'no_hp.between' => 'Nomor HP harus antara :min dan :max karakter.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari :max karakter.',
            'username.required' => 'Nama panggilan tidak boleh kosong.',
            'username.max' => 'Nama panggilan tidak boleh lebih dari :max karakter.',
            'password.min' => 'Password harus terdiri dari minimal :min karakter.',
        ]);

        $bidan->update([
            'nik' => $data['nik'],
            'nip' => $data['nip'],
            'nama_bidan' => $data['nama_bidan'],
            'tgl_lahir' => $data['tgl_lahir'],
            'alamat' => $data['alamat'],
            'no_hp' => $data['no_hp'],
        ]);

        // Perbarui data user
        $user = $bidan->user; // Mengambil user
        if ($user) {
            $user->update([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);
        }

        return redirect()->route('bidan.index')->with('success', 'Data bidan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $bidan = Bidan::findOrFail($id);
        $bidan->delete();
        return redirect()->route('bidan.index')->with('success', 'Data bidan berhasil dihapus.');
    }
}