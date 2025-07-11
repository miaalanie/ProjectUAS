<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
    Route::get('/tentang', [GuestController::class, 'tentang'])->name('guest.tentang');
    
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


require __DIR__.'/auth.php';