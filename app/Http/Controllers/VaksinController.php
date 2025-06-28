<?php

namespace App\Http\Controllers;

use App\Models\Vaksin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VaksinController extends Controller
{

    public function index()
    {
        $vaksin = Vaksin::orderBy('jenis_vaksin', 'asc')->get();
        return view('admin.vaksin.index', compact('vaksin'));
    }

    public function create()
    {
        return view('admin.vaksin.create');
    }

    public function edit($id)
    {
        $vaksin = Vaksin::findOrFail($id);
        return view('admin.vaksin.edit', compact('vaksin'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'jenis_vaksin' => 'required|unique:vaksin,jenis_vaksin',
            'stok' => 'required',
        ], [
            'jenis_vaksin.required' => 'Jenis vaksin tidak boleh kosong.',
            'jenis_vaksin.unique' => 'Jenis vaksin sudah ada.',
            'stok.required' => 'Stok tidak boleh kosong.',
        ]);

        $input = $request->all();

        Vaksin::create($input);
        return redirect()->route('vaksin.index')->with('success', 'Data vaksin berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'jenis_vaksin' => 'required|max:255',
            'stok' => 'required',
        ], [
            'jenis_vaksin.required' => 'Jenis vaksin tidak boleh kosong.',
            'jenis_vaksin.max' => 'Jenis vaksin tidak valid.',
            'stok.required' => 'Stok tidak boleh kosong.',
        ]);

        // Mendapatkan instance vaksin berdasarkan ID
        $vaksin = Vaksin::findOrFail($id);

        $input = $request->all();


        $vaksin->update($input);
        return redirect()->route('vaksin.index')->with('success', 'Data vaksin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $vaksin = Vaksin::findOrFail($id);
        $vaksin->delete();
        return redirect()->route('vaksin.index')->with('success', 'Data vaksin berhasil dihapus.');
    }
}
