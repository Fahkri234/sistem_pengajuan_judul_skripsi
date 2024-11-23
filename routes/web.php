<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PengajuanJudulController;
use App\Http\Controllers\SuratPengantarController;
use App\Http\Controllers\DashboardController;
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
    return view('auth.login');
});
// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Pengajuan Judul routes
// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
// });
//     Route::post('/pengajuan-judul', [PengajuanJudulController::class, 'store']);
//     Route::post('/seleksi-judul/{judul}', [PengajuanJudulController::class, 'seleksiJudul'])->middleware('role:prodi');
//     Route::post('/pembayaran', [PembayaranController::class, 'store'])->middleware('role:mahasiswa');
//     Route::post('/surat-pengantar', [SuratPengantarController::class, 'store'])->middleware('role:staff_prodi');
//     Route::get('/laporan', [LaporanController::class, 'rekapitulasi'])->middleware('role:staff_prodi');
// });
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/pengajuan-judul/create', [PengajuanJudulController::class, 'create'])->name('pengajuan_judul.create');
    Route::post('/pengajuan-judul/store', [PengajuanJudulController::class, 'store'])->name('pengajuan_judul.store');
    Route::get('/pengajuan-judul', [PengajuanJudulController::class, 'index'])->name('pengajuan_judul.index');
    Route::post('/pengajuan-judul/upload/{id}', [PengajuanJudulController::class, 'uploadBukti'])->name('pengajuan_judul.uploadBukti');
});

Route::middleware(['auth', 'role:prodi'])->group(function () {
    Route::get('/pengajuan-judul/seleksi', [PengajuanJudulController::class, 'seleksiIndex'])->name('pengajuan_judul.seleksiIndex');
    Route::get('/pengajuan-judul/seleksi/{id}', [PengajuanJudulController::class, 'seleksiForm'])->name('pengajuan_judul.seleksiForm');
    Route::post('/pengajuan-judul/seleksi/{id}', [PengajuanJudulController::class, 'seleksiUpdate'])->name('pengajuan_judul.seleksiUpdate');
});

Route::middleware(['auth', 'role:staff_prodi'])->group(function () {
    Route::get('/pengajuan-judul/{id}/upload-surat', [SuratPengantarController::class, 'showUploadSuratForm'])->name('upload.surat');
    Route::post('/pengajuan-judul/{id}/upload-surat', [SuratPengantarController::class, 'storeSuratPengantar'])->name('surat_pengantar.store');
    Route::get('/laporan/rekapitulasi', [LaporanController::class, 'rekapitulasi'])->name('laporan.rekapitulasi');
});
