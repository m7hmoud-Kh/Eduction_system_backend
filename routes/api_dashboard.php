<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\BranchController;
use App\Http\Controllers\Dashboard\HeadBranchController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});


Route::group([
    'middleware' => ['auth','role:manager'],
    'prefix' => 'branches/'
], function () {
    Route::get('/', [BranchController::class, 'index']);
    Route::post('/', [BranchController::class, 'store']);
    Route::get('{branch}', [BranchController::class, 'show']);
    Route::post('{branch}', [BranchController::class, 'update']);
    Route::delete('{branch}', [BranchController::class, 'destory']);
});


Route::group([
    'middleware' => ['auth','role:manager'],
    'prefix' => 'head-branch/'
], function () {
    Route::get('/', [HeadBranchController::class, 'index']);
    Route::post('/', [HeadBranchController::class, 'store']);
    Route::get('{headofBranch}', [HeadBranchController::class, 'show']);
    Route::post('{headofBranch}', [HeadBranchController::class, 'update']);
    Route::delete('{headofBranch}', [HeadBranchController::class, 'destory']);

});