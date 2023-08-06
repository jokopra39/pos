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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
//API route for register new user
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
//unprotected route mahasiswa bacause have no form login
Route::resource('/mahasiswa', \App\Http\Controllers\Api\MahasiswasApiController::class); // route mahasiswa
Route::post('/delete', [App\Http\Controllers\API\MahasiswasApiController::class, 'delete']);
Route::post('/update', [App\Http\Controllers\API\MahasiswasApiController::class, 'update']);
//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });
    //Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
    // Route::resource('/mahasiswa', \App\Http\Controllers\Api\MahasiswasApiController::class); 
    // Route::post('/delete', [App\Http\Controllers\API\MahasiswasApiController::class, 'delete']);
    // Route::post('/update', [App\Http\Controllers\API\MahasiswasApiController::class, 'update']);
    // API route for logout user
    Route::get('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});