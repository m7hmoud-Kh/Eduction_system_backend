<?php

use App\Http\Controllers\Dashboard\BranchController;
use App\Http\Controllers\Dashboard\ClassRoomController;
use App\Http\Controllers\Dashboard\SubjectController;
use App\Http\Controllers\Dashboard\TeacherController;
use App\Http\Controllers\Website\ClassRoomStudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\StudentController;



Route::post('/register', [StudentController::class, 'register']);
Route::post('/login', [StudentController::class, 'login']);
Route::get('/govenorate', [StudentController::class, 'getAllGov']);
Route::get('/branches', [BranchController::class, 'index']);
Route::get('/teachers/{branch_id}', [TeacherController::class, 'all_teacher_in_branch']);
Route::get('/subjects/{branch_id}', [SubjectController::class, 'all_subject_in_branch']);
Route::get('/classrooms-teacher/{branch_id}/{teacher_id}', [
    ClassRoomController::class, 'getClassRoomsByBranchIdAndTeacherId'
]);

Route::get('/classrooms-subject/{branch_id}/{subject_id}', [
    ClassRoomController::class, 'getClassRoomsByBranchIdAndSubjectId'
]);

Route::get('get-remaining-students/{classroom_id}', [ClassRoomStudentController::class, 'remainingStudents']);

Route::group([
    'middleware' => 'auth:student'
], function () {
    Route::delete('students/{id}', [StudentController::class, 'destory']);
    Route::post('/logout', [StudentController::class, 'logout']);
    Route::get('/students/refresh', [StudentController::class, 'refresh']);
    Route::post('/students/{id}', [StudentController::class, 'update']);

    Route::post('/register-classroom', [ClassRoomStudentController::class, 'registerNow']);

    Route::delete('/unsubscribe-classroom', [ClassRoomStudentController::class, 'unsubscribe']);
});
