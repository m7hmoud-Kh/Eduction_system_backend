<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\StudentController;
use App\Http\Controllers\Website\ProductController;
use App\Http\Controllers\Website\OrderController;
use App\Http\Controllers\Website\TransactionController;
use App\Http\Controllers\Website\CartController;



Route::post('/register', [StudentController::class, 'register']);
Route::post('/login', [StudentController::class, 'login']);

Route::group([
    'middleware' => 'auth:student'
], function () {
    Route::delete('students/{id}', [StudentController::class, 'destory']);
    Route::post('/logout', [StudentController::class, 'logout']);
    Route::get('/students/refresh', [StudentController::class, 'refresh']);
    Route::post('/students/{id}', [StudentController::class, 'update']);
});

Route::group([
    'middleware' => 'auth:student'
], function () {
    Route::get('products', [ProductController::class, 'index']);
});

Route::group([
    'middleware' => 'auth:student'
], function () {
    Route::get('orders', [OrderController::class, 'index']);
    Route::post('orders', [OrderController::class, 'store']);
    Route::post('orders/{id}', [OrderController::class, 'update']);
    Route::get('show_order_with_details/{id}', [OrderController::class, 'show_order_with_details']);
   
});

// Route::group([
//     'middleware' => 'auth:student'
// ], function () {
//     Route::get('transactions', [TransactionController::class, 'index']);
//     Route::post('transactions/{id}', [TransactionController::class, 'update']);
  
   
// });

Route::group([
    'middleware' => 'auth:student'
], function () {
    Route::post('create-cart', [CartController::class, 'store']);
    Route::get('show-cart', [CartController::class, 'show']);
    Route::post('ubdate-cart', [CartController::class, 'update']);
    Route::delete('delete-cart', [CartController::class, 'destroy']);
  
   
});

