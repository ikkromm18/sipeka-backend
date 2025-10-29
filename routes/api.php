<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FieldSuratController;
use App\Http\Controllers\GlobalController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PengajuanSuratController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user1', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function (Request $request) {
    return 'Test';
});

Route::get('/', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
// Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', fn(Request $request) => $request->user());
    Route::post('/profile/update', [AuthController::class, 'update']);

    Route::get('/pengajuan', [PengajuanSuratController::class, 'index']); // list pengajuan user
    Route::get('/pengajuan/{id}', [PengajuanSuratController::class, 'show']); // detail pengajuan

    Route::get('/pengajuanterbaru', [PengajuanSuratController::class, 'terbaru']);

    Route::post('/ubahpassword', [AuthController::class, 'ubahPassword']);

    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::get('/notifications/unread', [NotificationController::class, 'unread']);
    Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
});

Route::get('/pengajuancetak{id}', [PdfController::class, 'cetak']);

Route::post('forgot-password', [AuthController::class, 'sendResetLinkEmail']);
Route::post('reset-password', [AuthController::class, 'reset']);


Route::get('/getFieldSurat/{id}', [FieldSuratController::class, 'getFieldSurat']);

Route::get('/getNomorAdmin', [GlobalController::class, 'index']);




Route::post('/pengajuan', [PengajuanSuratController::class, 'store']);
