<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('login-form', [App\Http\Controllers\LoginController::class, 'index']);
Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
Route::get('purchase-order', [App\Http\Controllers\PurchaseOrderController::class, 'index']);
Route::get('sales', [App\Http\Controllers\SalesController::class, 'index']);