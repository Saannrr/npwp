<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/users/register', [\App\Http\Controllers\UserController::class, 'register']);
Route::post('/users/login', [\App\Http\Controllers\UserController::class, 'login']);

Route::middleware(\App\Http\Middleware\ApiAuthMiddleware::class)->group(function () {
    //    user routes
    Route::get('/users/current', [\App\Http\Controllers\UserController::class, 'getUser']);
    Route::patch('/users/current', [\App\Http\Controllers\UserController::class, 'update']);
    Route::delete('/users/logout', [\App\Http\Controllers\UserController::class, 'logout']);

    //   identitas routes
    Route::get('/identitas', [\App\Http\Controllers\IdentitasController::class, 'getAllIdentitas']);
    Route::get('/cari-identitas', [\App\Http\Controllers\IdentitasController::class, 'cariIdentitas']);
    Route::get('/cari-identitas-by-npwp', [\App\Http\Controllers\IdentitasController::class, 'cariIdentitasByNpwp']);

    // identitas perusahaan routes
    Route::get('/identitas-perusahaan', [\App\Http\Controllers\IdentitasPerusahaanController::class, 'getAll']);
    Route::get('/cari-identitas-perusahaan', [\App\Http\Controllers\IdentitasPerusahaanController::class, 'cariIdentitasPerusahaan']);

    //   pengaturan routes
    Route::get('/pengaturan', [\App\Http\Controllers\PengaturanController::class, 'getAll']);
    Route::post('/pengaturan/create', [\App\Http\Controllers\PengaturanController::class, 'create']);
    Route::put('/pengaturan/{id}', [\App\Http\Controllers\PengaturanController::class, 'update']);
    Route::delete('/pengaturan/{id}', [\App\Http\Controllers\PengaturanController::class, 'destroy']);

    //   pphpasal routes
    Route::get('/pphpasal', [\App\Http\Controllers\PphpasalController::class, 'getAll']);
    Route::post('/pphpasal/create', [\App\Http\Controllers\PphpasalController::class, 'create']);
    Route::put('/pphpasal/{id}', [\App\Http\Controllers\PphpasalController::class, 'update']);
    Route::delete('/pphpasal/{id}', [\App\Http\Controllers\PphpasalController::class, 'destroy']);
    Route::get('/pphpasal/{id}', [\App\Http\Controllers\PphpasalController::class, 'getPphpasalById']);

    //   objekpajak routes
    Route::get('/objekpajak', [\App\Http\Controllers\ObjekpajakController::class, 'getAll']);
    Route::get('/cari-objekpajak', [\App\Http\Controllers\ObjekpajakController::class, 'cariObjekPajak']);

    //   dokumen pphpasal routes
    Route::get('/dokumen-pphpasal', [\App\Http\Controllers\DokumenPphpasalController::class, 'getAll']);
    Route::post('/dokumen-pphpasal/create', [\App\Http\Controllers\DokumenPphpasalController::class, 'create']);
    Route::delete('/dokumen-pphpasal/{id}', [\App\Http\Controllers\DokumenPphpasalController::class, 'destroy']);

    //   Pajak Penghasilan (posting pph routes)
    Route::get('/pajak-penghasilan', [\App\Http\Controllers\PajakPenghasilanController::class, 'getAll']);
    Route::get('/cari-pajak-penghasilan', [\App\Http\Controllers\PajakPenghasilanController::class, 'cariPajakPenghasilan']);
    Route::post('/posting-pph', [\App\Http\Controllers\PajakPenghasilanController::class, 'postPajakPenghasilan']);
    Route::delete('/pajak-penghasilan/{id}', [\App\Http\Controllers\PajakPenghasilanController::class, 'destroy']);
    Route::get('/cek-status-posting', [\App\Http\Controllers\PajakPenghasilanController::class, 'cekStatusPostingPajakPenghasilan']);

    // Perekaman BP
    Route::get('/perekaman-bp', [\App\Http\Controllers\PerekamanBpController::class, 'getAll']);
    Route::get('/cari-perekaman-bp', [\App\Http\Controllers\PerekamanBpController::class, 'cariPerekamanBp']);
    Route::get('/generate-id-billing/{id}', [\App\Http\Controllers\PerekamanBpController::class, 'generateIdBilling']);

    // Pembayaran Spt
    Route::get('/pembayaran-spt', [\App\Http\Controllers\PembayaranSptController::class, 'getAll']);
    Route::post('/pembayaran-spt/create', [\App\Http\Controllers\PembayaranSptController::class, 'create']);
    Route::delete('/pembayaran-spt/{id}', [\App\Http\Controllers\PembayaranSptController::class, 'destroy']);

    // Rekam SPT BP
    Route::get('/rekam-spt-bp', [\App\Http\Controllers\RekamSptBpController::class, 'getAll']);
    Route::post('/rekam-spt-bp/create', [\App\Http\Controllers\RekamSptBpController::class, 'create']);
    Route::delete('/rekam-spt-bp/{id}', [\App\Http\Controllers\RekamSptBpController::class, 'destroy']);

    // Penyiapan SPT
    Route::get('/penyiapan-spt', [\App\Http\Controllers\PenyiapanSptController::class, 'getAll']);
    Route::post('/penyiapan-spt/simpan-doss-dopp', [\App\Http\Controllers\PenyiapanSptController::class, 'simpan_doss_dopp']);
    Route::post('/penyiapan-spt/lengkapi-spt', [\App\Http\Controllers\PenyiapanSptController::class, 'lengkapiSpt']);
});
