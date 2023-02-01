<?php

use App\Http\Controllers\Dashboard\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



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
