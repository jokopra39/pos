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

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });
    //Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

    Route::resource('/posts', \App\Http\Controllers\Api\PostController::class); // tambahkan ini
    Route::resource('/purchaseorder', \App\Http\Controllers\Api\PurchaseOrderController::class);
    Route::resource('/tax', \App\Http\Controllers\Api\TbltaxController::class);
    Route::resource('/supplier', \App\Http\Controllers\Api\TblsupplierController::class);

    Route::resource('/productunit', \App\Http\Controllers\Api\TblproductunitController::class);
    Route::resource('/productcategory', \App\Http\Controllers\Api\TblproductcategoryController::class);
    Route::resource('/product', \App\Http\Controllers\Api\TblproductController::class);
    Route::resource('/customer', \App\Http\Controllers\Api\TblcustomerController::class);
    Route::resource('/sales', \App\Http\Controllers\Api\SalesController::class);
    Route::resource('/receiveproduct', \App\Http\Controllers\Api\ReceiveProductController::class);
    Route::resource('/invoice', \App\Http\Controllers\Api\InvoiceController::class);
   
    // API route for logout user
    Route::get('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});