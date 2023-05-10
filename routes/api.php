<?php

use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\KendaraanTransactionController;
use App\Http\Controllers\AuthController;
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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('jwt')->group(function () {
  Route::post('/kendaraan/check-stock', [KendaraanController::class, 'checkStock']);;
  
  Route::post('/kendaraan-transactions', [KendaraanTransactionController::class, 'store']);
  
  Route::get('/sales-report', [KendaraanTransactionController::class, 'getSalesReport']);
});


