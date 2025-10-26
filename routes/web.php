<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FieldSuratController;
use App\Http\Controllers\Admin\JenisSuratController;
use App\Http\Controllers\Admin\LaporanPengajuanController;
use App\Http\Controllers\Admin\PengajuanSuratController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UtilityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('role:Admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route::get('/pengajuan', [PengajuanSuratController::class, 'index'])->name('pengajuan.index');

    Route::resource('user', UserController::class);
    Route::put('/diverifikasi/{id}', [UserController::class, 'verifikasi'])->name('user.verifikasi');


    Route::resource('pengajuansurat', PengajuanSuratController::class);

    Route::put('/pengajuansurat/{id}/status/{status}', [PengajuanSuratController::class, 'updateStatus'])
        ->name('pengajuansurat.updateStatus');

    Route::get('/pengajuansurat/{id}/cetak', [PengajuanSuratController::class, 'cetakAdmin'])
        ->name('pengajuansurat.cetakadmin');


    Route::resource('jenissurat', JenisSuratController::class);

    Route::resource('settings', UtilityController::class);

    Route::resource('fieldsurat', FieldSuratController::class);

    Route::get('/laporan-pengajuan', [LaporanPengajuanController::class, 'index'])->name('laporanpengajuan.index');
    Route::get('/laporan-pengajuan/cetak', [LaporanPengajuanController::class, 'cetak'])->name('laporanpengajuan.cetak');
});

require __DIR__ . '/auth.php';
