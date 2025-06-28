<?php

use App\Http\Controllers\BalitaController;
use App\Http\Controllers\BidanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\PenimbanganController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VaksinController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('konten.auth.login');
})->middleware('auth');

// Login
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
});

// Register
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');

// Data Master Posyandu
// 1. Data Orang Tua
Route::resource('/orangtua', OrangTuaController::class)->middleware('role:admin');
// 2. Data Balita
Route::resource('/balita', BalitaController::class)->middleware('role:admin');
// 3. Data Bidan
Route::resource('/bidan', BidanController::class)->middleware('role:admin');

// Layanan
// 1. Imunisasi Anak
Route::resource('/imunisasi', ImunisasiController::class)->middleware('role:admin,bidan');
// 2. Penimbangan Anak
Route::resource('/penimbangan', PenimbanganController::class)->middleware('role:admin,bidan');

// Persediaan
// 1. Vaksin
Route::resource('/vaksin', VaksinController::class)->middleware('role:admin,bidan');

// Jadwal
// 1. Notifikasi Jadwal dan Pengingat
Route::controller(JadwalController::class)->middleware('role:admin,bidan,ortu')->group(function () {
    Route::resource('/jadwal', JadwalController::class);
    Route::get('/detail-jadwal/{id}', [JadwalController::class, 'show'])->name('jadwal.show');
    Route::get('/semua-notifikasi', [JadwalController::class, 'allnotif'])->name('notifikasi.semua');
});
