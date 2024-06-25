<?php

use App\Http\Controllers\api\OrderitemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\ProductController;

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

Route::group(['prefix' => 'users'], function() {
    Route::get('/', [UserController::class, 'index']); 
    Route::get('/{id}', [UserController::class, 'show']); 
    Route::post('/', [UserController::class, 'store']); 
    Route::put('/{id}', [UserController::class, 'update']); 
    Route::delete('/{id}', [UserController::class, 'destroy']); 
});
Route::group(['prefix' => 'product'], function() {
    Route::get('/', [ProductController::class, 'index']); 
    Route::get('/{id}', [ProductController::class,'show']); 
    Route::post('/', [ProductController::class,'store']); 
    Route::put('/{id}', [ProductController::class,'update']); 
    Route::delete('/{id}', [ProductController::class,'destroy']);
   
});
Route::group(['prefix' => 'orderItem'], function() {
    Route::get('/', [OrderitemController::class, 'index']); 
    Route::get('/{id}', [OrderitemController::class,'show']); 
    Route::post('/', [OrderitemController::class,'store']); 
    Route::put('/{id}', [OrderitemController::class,'update']); 
    Route::delete('/{id}', [OrderitemController::class,'destroy']);
 
   
});