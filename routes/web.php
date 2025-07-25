<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SnackRekomendasiController;
use App\Http\Controllers\UserController;
use Database\Seeders\SnackSeeder;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

 //GUEST
    Route::get('/dashboard-guest', [GuestController::class, 'dashboard'])->name('guest.dashboard');
    Route::get('/mulai-diagnosa', [GuestController::class, 'mulaiDiagnosa'])->name('guest.mulaiDiagnosa');
    Route::get('/guest-diagnosa', [GuestController::class, 'diagnosa'])->name('guest.diagnosa');
    Route::get('/tentang', [GuestController::class, 'tentang'])->name('guest.tentang');
    Route::get('/guest-store', [GuestController::class, 'tentang'])->name('guest.store');
    Route::get('/tampilan-suhu', [GuestController::class, 'suhu'])->name('guest.suhu');
    Route::get('/tampilan-heart-rate', [GuestController::class, 'heartRate'])->name('guest.heartRate');
    Route::get('/tampilan-mood', [GuestController::class, 'mood'])->name('guest.mood');
    Route::get('/tampilan-snack', [GuestController::class, 'snack'])->name('guest.snack');
   
// SAAT DIAGNOSA
    Route::post('/guests', [GuestController::class, 'store']);
    // routes/web.php atau api.php
    Route::post('/proses-mood', [MoodController::class, 'processMood']);
    // Route untuk mendapatkan data snack berdasarkan jenis_mood
    Route::get('/get-snack/{jenis_mood}', [SnackRekomendasiController::class, 'getSnack']);
    Route::post('/diagnoses', [GuestController::class, 'storeDiagnose']);

 //USER
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard-user', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/diagnosa', [UserController::class, 'diagnosa'])->name('user.diagnosa');
    Route::get('/riwayat', [UserController::class, 'riwayat'])->name('user.riwayat');
    Route::get('/mySnack', [UserController::class, 'mySnack'])->name('user.mySnack');
    Route::get('/myStatistik', [UserController::class, 'statistik'])->name('user.statistik');
});

// ADMIN
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard-admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Master Data
    Route::get('/pengguna', [AdminController::class, 'pengguna'])->name('admin.pengguna');
    Route::get('/snack', [AdminController::class, 'snack'])->name('admin.snack');
    // Master Data Snack
    Route::get('/snack', [AdminController::class, 'snack'])->name('admin.snack');
    Route::get('/snack/tambah', [AdminController::class, 'tambahSnack'])->name('admin.snack_tambah');
    Route::post('/snack/simpan', [AdminController::class, 'simpanSnack'])->name('admin.snack.simpan');
    Route::get('/snack/{id}/edit', [AdminController::class, 'editSnack'])->name('admin.snack.edit');
    Route::put('/snack/{id}/update', [AdminController::class, 'updateSnack'])->name('admin.snack.update');
    Route::delete('/snack/{id}/hapus', [AdminController::class, 'hapusSnack'])->name('admin.snack.hapus');

    Route::get('/rules', [AdminController::class, 'rules'])->name('admin.rules');

    // Transaksi
    Route::get('/log-mood', [AdminController::class, 'logMood'])->name('admin.log-mood');
    Route::get('/riwayat-snack', [AdminController::class, 'riwayatSnack'])->name('admin.riwayat-snack');
    Route::get('/statistik-konsumsi', [AdminController::class, 'statistikKonsumsi'])->name('admin.statistik-konsumsi');

    // Monitoring
    Route::get('/bad-mood', [AdminController::class, 'badMood'])->name('admin.bad-mood');
    Route::get('/frekuensi-snack', [AdminController::class, 'frekuensiSnack'])->name('admin.frekuensi-snack');


    // Laporan
    Route::get('/laporan-user', [AdminController::class, 'laporanUser'])->name('admin.laporan-user');
    Route::get('/laporan-akumulasi', [AdminController::class, 'laporanAkumulasi'])->name('admin.laporan-akumulasi');
});

// Tambah user
Route::get('/admin/pengguna/tambah', [AdminController::class, 'tambah'])->name('admin.pengguna.tambah');
Route::post('/admin/pengguna/tambah', [AdminController::class, 'simpan'])->name('admin.pengguna.simpan');

// Edit user
Route::get('/admin/pengguna/{id}/edit', [AdminController::class, 'edit'])->name('admin.pengguna.edit');
Route::put('/admin/pengguna/{id}', [AdminController::class, 'update'])->name('admin.pengguna.update');

// Hapus user
Route::delete('/admin/pengguna/{id}', [AdminController::class, 'hapus'])->name('admin.pengguna.hapus');


require __DIR__.'/auth.php';
