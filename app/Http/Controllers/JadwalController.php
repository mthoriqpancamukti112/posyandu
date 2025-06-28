<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index(Request $request)
    {

        $jadwal = Jadwal::with('users', 'bidans')->orderBy('created_at', 'desc')->get();
        return view('admin.jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        return view('admin.jadwal.create');
    }

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        return view('admin.jadwal.edit', compact('jadwal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'message' => 'required|max:255',
            'start' => 'required|date',
            'lokasi' => 'required',
            'keterangan' => 'nullable',
            'color' => 'required|string',
        ], [
            'title.required' => 'Judul tidak boleh kosong.',
            'title.max' => 'Judul tidak boleh lebih dari :max karakter.',
            'message.required' => 'Pesan tidak boleh kosong.',
            'message.max' => 'Pesan tidak boleh lebih dari :max karakter.',
            'start.required' => 'Tanggal tidak boleh kosong',
            'lokasi.required' => 'Lokasi tidak boleh kosong.',
            'color.required' => 'Isi warna.',
        ]);

        $input = $request->all();
        $input['user_id'] = auth()->id();
        $input['bidan_id'] = auth()->user()->bidan_id;

        Jadwal::create($input);
        return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'message' => 'required|max:255',
            'start' => 'required|date',
            'lokasi' => 'required',
            'keterangan' => 'nullable',
            'color' => 'required|string',
        ], [
            'title.required' => 'Judul tidak boleh kosong.',
            'title.max' => 'Judul tidak boleh lebih dari :max karakter.',
            'message.required' => 'Pesan tidak boleh kosong.',
            'message.max' => 'Pesan tidak boleh lebih dari :max karakter.',
            'start.required' => 'Tanggal tidak boleh kosong',
            'lokasi.required' => 'Lokasi tidak boleh kosong.',
            'color.required' => 'Isi warna.',
        ]);

        // Mendapatkan instance vaksin berdasarkan ID
        $jadwal = Jadwal::findOrFail($id);

        $input = $request->all();
        $input['user_id'] = auth()->id();
        $input['bidan_id'] = auth()->user()->bidan_id;

        $jadwal->update($input);
        return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil dihapus.');
    }

    public function show($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        return view('admin.jadwal.show', compact('jadwal'));
    }

    public function allnotif()
    {
        $jadwal = Jadwal::orderBy('created_at', 'desc')->get();
        return view('admin.jadwal.semua-notifikasi', compact('jadwal'));
    }
}
