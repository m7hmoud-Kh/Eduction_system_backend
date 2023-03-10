<?php

use App\Http\Controllers\Dashboard\AssistantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\BranchController;
use App\Http\Controllers\Dashboard\HeadBranchController;
use App\Http\Controllers\Dashboard\ShopController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\AcademicYearController;
use App\Http\Controllers\Dashboard\SemesterController;
use App\Http\Controllers\Dashboard\SubjectController;
use App\Http\Controllers\Dashboard\TeacherController;

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
    'middleware' => ['auth','role:head_of_branch|manager'],
    'prefix' => 'head-branch/'
], function () {
    Route::get('/', [HeadBranchController::class, 'index']);
    Route::post('/', [HeadBranchController::class, 'store']);
    Route::get('{headofBranch}', [HeadBranchController::class, 'show']);
    Route::post('{headofBranch}', [HeadBranchController::class, 'update']);
    Route::delete('{headofBranch}', [HeadBranchController::class, 'destory']);
});


Route::group([
    'middleware' => ['auth','role:head_of_branch'],
], function () {
    Route::get('assistants', [AssistantController::class, 'index']);
    Route::post('assistants', [AssistantController::class, 'store']);
    Route::get('assistants/{id}', [AssistantController::class, 'show']);
    Route::post('assistants/{id}', [AssistantController::class, 'update']);
    Route::delete('assistants/{id}', [AssistantController::class, 'destory']);
});


Route::group([
    'middleware' => ['auth','role:assistant']
], function () {
    Route::get('teachers', [TeacherController::class, 'index']);
    Route::post('teachers', [TeacherController::class, 'store']);
    Route::get('teachers/{id}', [TeacherController::class, 'show']);
    Route::post('teachers/{id}', [TeacherController::class, 'update']);
    Route::delete('teachers/{id}', [TeacherController::class, 'destory']);
});


Route::group([
    'middleware' => ['auth','role:assistant'],
], function () {
    Route::get('academicYears', [AcademicYearController::class, 'index']);
    Route::post('academicYears', [AcademicYearController::class, 'store']);
    Route::get('academicYears/{id}', [AcademicYearController::class, 'show']);
    Route::post('academicYears/{id}', [AcademicYearController::class, 'update']);
    Route::delete('academicYears/{id}', [AcademicYearController::class, 'destory']);
});


Route::group([
    'middleware' => ['auth','role:assistant'],
], function () {
    Route::get('semesters', [SemesterController::class, 'index']);
    Route::post('semesters', [SemesterController::class, 'store']);
    Route::get('semesters/{id}', [SemesterController::class, 'show']);
    Route::post('semesters/{id}', [SemesterController::class, 'update']);
    Route::delete('semesters/{id}', [SemesterController::class, 'destory']);
});


Route::group([
    'middleware' => ['auth','role:assistant'],
], function () {
    Route::get('subjects', [SubjectController::class, 'index']);
    Route::post('subjects', [SubjectController::class, 'store']);
    Route::get('subjects/{id}', [SubjectController::class, 'show']);
    Route::post('subjects/{id}', [SubjectController::class, 'update']);
    Route::delete('subjects/{id}', [SubjectController::class, 'destory']);
});

Route::group([
    'middleware' => ['auth','role:assistant']
], function () {
    Route::get('shops', [ShopController::class, 'index']);
    Route::post('shops', [ShopController::class, 'store']);
    Route::get('shops/{id}', [ShopController::class, 'show']);
    Route::post('shops/{id}', [ShopController::class, 'update']);
    Route::delete('shops/{id}', [ShopController::class, 'destroy']);
});

Route::group([
    'middleware' => ['auth','role:assistant']
    
], function () {
    Route::get('categories', [CategoryController::class, 'index']);
    Route::post('categories', [CategoryController::class, 'store']);
    Route::get('categories/{id}', [CategoryController::class, 'show']);
    Route::post('categories/{id}', [CategoryController::class, 'update']);
    Route::delete('categories/{id}', [CategoryController::class, 'destroy']);
});

