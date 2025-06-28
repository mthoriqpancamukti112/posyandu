<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Balita;
use App\Models\Bidan;
use App\Models\Penimbangan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PenimbanganController extends Controller
{
    public function index()
    {
        $penimbangan = Penimbangan::with('users', 'bidans')->orderBy('created_at', 'desc')->get();
        return view('admin.penimbangan.index', compact('penimbangan'));
    }

    public function create()
    {
        $balitas = Balita::all();
        $bidans = Bidan::all();
        return view('admin.penimbangan.create', compact('balitas', 'bidans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'balita_id' => [
                'required',
                Rule::unique('penimbangan')->where(function ($query) use ($request) {
                    return $query->where('tgl_timbang', $request->tgl_timbang)
                        ->where('balita_id', $request->balita_id);
                }),
            ],
            'tgl_timbang' => 'required|date',
            'usia' => 'required',
            'berat_badan' => 'required',
            'tinggi_badan' => 'required',
            'perkembangan' => [
                'required', Rule::in(['Y', 'T']),
            ],
            'keterangan' => 'nullable',
        ], [
            'balita_id.required' => 'Nama anak tidak boleh kosong.',
            'balita_id.unique' => 'Nama balita sudah melakukan penimbangan pada tanggal tersebut.',
            'tgl_timbang.required' => 'Tanggal tidak boleh kosong.',
            'tgl_timbang.date' => 'Format tanggal tidak valid.',
            'usia.required' => 'Usia tidak boleh kosong.',
            'berat_badan.required' => 'Berat badan tidak boleh kosong.',
            'tinggi_badan.required' => 'Tinggi badan tidak boleh kosong.',
            'perkembangan.required' => 'Perkembangan tidak boleh kosong.',
        ]);

        $input = $request->all();
        $input['user_id'] = auth()->id();
        $input['bidan_id'] = auth()->user()->bidan_id;

        Penimbangan::create($input);
        return redirect()->route('penimbangan.index')->with('success', 'Data penimbangan berhasil disimpan.');
    }

    public function destroy($id)
    {
        $penimbangan = Penimbangan::findOrFail($id);
        $penimbangan->delete();
        return redirect()->route('penimbangan.index')->with('success', 'Data penimbangan berhasil dihapus.');
    }
}