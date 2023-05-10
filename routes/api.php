<?php

use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\KendaraanTransactionController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/kendaraan/check-stock', [KendaraanController::class, 'checkStock']);;

Route::post('/kendaraan-transactions', [KendaraanTransactionController::class, 'store']);

