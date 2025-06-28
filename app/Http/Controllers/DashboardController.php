<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\Bidan;
use App\Models\Imunisasi;
use App\Models\OrangTua;
use App\Models\Penimbangan;
use App\Models\Vaksin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlah_balita = Balita::count();
        $jumlah_ortu = OrangTua::count();
        $jumlah_bidan = Bidan::count();
        $jumlah_vaksin = Vaksin::count();
        $jumlah_imunisasi = Imunisasi::count();
        $jumlah_penimbangan = Penimbangan::count();
        $jumlah_bidan = Bidan::count();

        // Menghitung jumlah balita berdasarkan jenis kelamin
        $jumlah_laki_laki = Balita::where('jenis_kelamin', 'L')->count();
        $jumlah_perempuan = Balita::where('jenis_kelamin', 'P')->count();

        // Inisialisasi variabel yang diperlukan
        $dailyTotalsY = [];
        $dailyTotalsT = [];
        $TotalsPenimbanganY = [];
        $TotalsPenimbanganT = [];
        $penimbanganData = [];
        $balitaData = [];

        $orangtuaId = Auth::user()->orangtua_id;

        // Ambil balita yang terkait dengan orang tua yang masuk
        $balitaData = Balita::where('orangtua_id', $orangtuaId)->get();
        $balitaIds = $balitaData->pluck('id');
        $penimbanganData = Penimbangan::whereIn('balita_id', $balitaIds)->get();

        // Data untuk admin
        $vaksinData = Imunisasi::whereIn('kondisi', ['Y', 'T'])->get();
        $groupedData = $vaksinData->groupBy('tanggal');

        foreach ($groupedData as $date => $group) {
            $dailyTotalsY[$date] = $group->where('kondisi', 'Y')->count();
            $dailyTotalsT[$date] = $group->where('kondisi', 'T')->count();
        }

        $penimbangan = Penimbangan::whereIn('perkembangan', ['Y', 'T'])->get();
        $groupedPenimbanganData = $penimbangan->groupBy('tgl_timbang');

        foreach ($groupedPenimbanganData as $date => $group) {
            $TotalsPenimbanganY[$date] = $group->where('perkembangan', 'Y')->count();
            $TotalsPenimbanganT[$date] = $group->where('perkembangan', 'T')->count();
        }


        return view('admin.dashboard', compact(
            'jumlah_balita',
            'jumlah_ortu',
            'jumlah_bidan',
            'jumlah_vaksin',
            'jumlah_imunisasi',
            'jumlah_bidan',
            'jumlah_penimbangan',
            'jumlah_laki_laki',
            'jumlah_perempuan',
            'dailyTotalsY',
            'dailyTotalsT',
            'TotalsPenimbanganY',
            'TotalsPenimbanganT',
            'penimbanganData',
            'balitaData',
        ));
    }
}
