<?php

use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\DokterController;
use App\Http\Controllers\Api\Admin\JadwalController;
use App\Http\Controllers\Api\Admin\JadwalDetailController;
use App\Http\Controllers\Api\Admin\PasienController;
use App\Http\Controllers\Api\Admin\PengunjungController;
use App\Http\Controllers\Api\Admin\PoliController;
use App\Http\Controllers\Api\Admin\PublishController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Public\DokterController as PublicDokterController;
use App\Http\Controllers\Api\Public\JadwalController as PublicJadwalController;
use App\Http\Controllers\Api\Public\PoliController as PublicPoliController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// public api
Route::get('dokter', [PublicDokterController::class, 'index']);
Route::get('poli', [PublicPoliController::class, 'index']);
Route::get('jadwal', [PublicJadwalController::class, 'index']);
Route::post('jadwal', [PublicJadwalController::class, 'store']);
// end public api

// auth
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});
// end auth

Route::middleware('auth:api')->group(function () {
    Route::group([
        'prefix'     => 'admin',
        'as'         => 'admin.',
        'middleware' => ['role:admin'],
    ], function () {
        Route::post('publish', PublishController::class);

        Route::get('dashboard', [DashboardController::class, 'index']);

        Route::apiResource('poli', PoliController::class);
        Route::resource('dokter', DokterController::class);
        Route::apiResource('jadwal', JadwalController::class);

        Route::get('/jadwal/{jadwal_id}/jadwal-detail', [JadwalDetailController::class, 'index']);
        Route::apiResource('jadwal-detail', JadwalDetailController::class)->except(['index']);

        Route::get('pasien', [PasienController::class, 'index']);
        Route::get('pengunjung', [PengunjungController::class, 'index']);
    });
});