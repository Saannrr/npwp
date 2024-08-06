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

//   pengaruran routes
    Route::get('/pengaturan/cari-identitas', [\App\Http\Controllers\PengaturanController::class, 'cariIdentitas']);
    Route::get('/pengaturan', [\App\Http\Controllers\PengaturanController::class, 'getAll']);
    Route::post('/pengaturan/create', [\App\Http\Controllers\PengaturanController::class, 'create']);
    Route::put('/pengaturan/{id}', [\App\Http\Controllers\PengaturanController::class, 'update']);
    Route::delete('/pengaturan/{id}', [\App\Http\Controllers\PengaturanController::class, 'destroy']);
});
