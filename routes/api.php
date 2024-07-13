<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SptController;
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

// Kawasan Auth Sanctum
Route::middleware(['auth:sanctum'])->group(function (){

Route::post('/logout', [AuthController::class, 'logout']);
Route::apiResource('spts', SptController::class);
Route::get('/user', [AuthController::class, 'userDetail']);

});

//Kawasan bebas Sanctum
Route::post('/login', [AuthController::class, 'login']);
