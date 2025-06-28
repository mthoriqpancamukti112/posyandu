<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\Imunisasi;
use App\Models\Vaksin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class ImunisasiController extends Controller
{

    public function index()
    {
        $imunisasi = Imunisasi::with('balitas', 'vaksins', 'users', 'bidans')->get();

        // Kelompokkan data berdasarkan tanggal dan jenis vaksin
        $rekap_vaksin = Imunisasi::select('tanggal', 'vaksin_id', 'vaksin.jenis_vaksin')
            ->join('vaksin', 'imunisasi.vaksin_id', '=', 'vaksin.id')
            ->groupBy('tanggal', 'vaksin_id', 'vaksin.jenis_vaksin')
            ->get()
            ->map(function ($vaksin) {
                // Hitung jumlah anak yang diimunisasi
                $vaksin->jumlah_balita = Imunisasi::where('tanggal', $vaksin->tanggal)
                    ->where('vaksin_id', $vaksin->vaksin_id)
                    ->count();

                // Ambil nama anak-anak yang diimunisasi
                $vaksin->nama_balita = Imunisasi::where('tanggal', $vaksin->tanggal)
                    ->where('vaksin_id', $vaksin->vaksin_id)
                    ->with('balitas')
                    ->get()
                    ->pluck('balitas.nama_anak')
                    ->toArray();

                return $vaksin;
            });

        return view('admin.imunisasi.index', compact('imunisasi', 'rekap_vaksin'));
    }

    public function create()
    {
        $today = now()->toDateString();
        $balitas = Balita::with(['orangtuas', 'imunisasi' => function ($query) use ($today) {
            $query->where('tanggal', $today);
        }])
            ->get()
            ->map(function ($balita) {
                $balita->sudah_imunisasi = $balita->imunisasi->isNotEmpty();
                return $balita;
            });

        $vaksins = Vaksin::all();

        return view('admin.imunisasi.create', compact('balitas', 'vaksins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'balita_id' => [
                'required',
                Rule::unique('imunisasi')->where(function ($query) use ($request) {
                    return $query->where('tanggal', $request->tanggal)
                        ->where('balita_id', $request->balita_id);
                }),
            ],
            'vaksin_id' => 'nullable',
            'tanggal' => 'required|date',
            'kondisi' => [
                'required', Rule::in(['Y', 'T']),
            ],
            'usia' => 'required',
        ], [
            'balita_id.required' => 'Nama anak tidak boleh kosong.',
            'balita_id.unique' => 'Nama balita sudah melakukan imunisasi pada tanggal tersebut.',
            'tanggal.required' => 'Tanggal tidak boleh kosong.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'kondisi.required' => 'Kondisi tidak boleh kosong.',
            'usia.required' => 'Usia tidak boleh kosong.'
        ]);

        // Handling Vaksin stock decrement
        $vaksin = Vaksin::find($request->vaksin_id);
        if ($vaksin && $request->kondisi === 'Y') {
            if ($vaksin->stok <= 0) {
                return redirect()->back()->with('error', 'Stok Vaksin Habis');
            }
            $vaksin->stok--;
            $vaksin->save();
        }

        $input = $request->all();
        $input['user_id'] = auth()->id();
        $input['bidan_id'] = auth()->user()->bidan_id;

        Imunisasi::create($input);
        return redirect()->route('imunisasi.index')->with('success', 'Data imunisasi berhasil disimpan.');
    }

    public function destroy($id)
    {
        $imunisasi = Imunisasi::findOrFail($id);
        $imunisasi->delete();
        return redirect()->route('imunisasi.index')->with('success', 'Data imunisasi berhasil dihapus.');
    }
}