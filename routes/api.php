<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\KodeBarangController;
use App\Http\Controllers\KywnCodeController;
use App\Http\Controllers\MerkController;
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


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::resource('kywn_code', KywnCodeController::class)->except([
        'create', 'edit'
    ]);

    Route::resource('merk', MerkController::class)->except([
        'create', 'edit'
    ]);

    Route::resource('kode_barang', KodeBarangController::class)->except([
        'create', 'edit'
    ]);

    Route::resource('item', ItemController::class)->except([
        'create', 'edit'
    ]);
});