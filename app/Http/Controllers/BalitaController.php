<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\OrangTua;
use Illuminate\Http\Request;

class BalitaController extends Controller
{
    public function index()
    {
        $balita = Balita::with('orangtuas')->orderBy('nama_anak', 'asc')->get();
        return view('admin.balita.index', compact('balita'));
    }

    public function create()
    {
        $orangtuas = OrangTua::all();
        return view('admin.balita.create', compact('orangtuas'));
    }

    public function edit($id)
    {
        $balita = Balita::findOrFail($id);
        $orangtuas = OrangTua::all();
        return view('admin.balita.edit', compact('balita', 'orangtuas'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'nik' => 'required|unique:balita|max:16',
            'orangtua_id' => 'required|not_in:0',
            'nama_anak' => 'required|max:255',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required|date',
        ], [
            'nik.required' => 'NIK tidak boleh kosong.',
            'nik.unique' => 'NIK sudah ada.',
            'nik.max' => 'NIK tidak valid.',
            'orangtua_id.required' => 'Orang tua tidak boleh kosong.',
            'nama_anak.required' => 'Nama balita tidak boleh kosong.',
            'nama_anak.max' => 'Nama balita tidak valid.',
            'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong.',
            'tgl_lahir.required' => 'Tanggal lahir tidak boleh kosong.',
            'tgl_lahir.date' => 'Format tanggal lahir tidak valid.',
        ]);

        $input = $request->all();

        Balita::create($input);
        return redirect()->route('balita.index')->with('success', 'Data balita berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'nik' => 'required|max:255',
            'nama_anak' => 'required|max:255',
            'orangtua_id' => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required|date',
        ], [
            'nik.required' => 'NIK tidak boleh kosong.',
            'nik.max' => 'NIK tidak valid.',
            'orangtua_id.required' => 'Orang tua balita tidak boleh kosong.',
            'nama_anak.required' => 'Nama balita tidak boleh kosong.',
            'nama_anak.max' => 'Nama balita tidak valid.',
            'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong.',
            'tgl_lahir.required' => 'Tanggal lahir tidak boleh kosong.',
            'tgl_lahir.date' => 'Format tanggal lahir tidak valid.',
        ]);

        // Mendapatkan instance barang berdasarkan ID
        $balita = Balita::findOrFail($id);

        $input = $request->all();


        $balita->update($input);
        return redirect()->route('balita.index')->with('success', 'Data balita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $balita = Balita::findOrFail($id);
        $balita->delete();
        return redirect()->route('balita.index')->with('success', 'Data balita berhasil dihapus.');
    }
}
