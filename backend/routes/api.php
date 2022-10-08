<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController; 


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group(['prefix' => 'admin'], function () {
    Route::group(["middleware" => "JWTAdmin"], function(){
        Route::post('register', [AdminController::class, 'register']);
        Route::post('delete-user', [AdminController::class, 'deleteUser']);
        Route::post('instructors', [AdminController::class, 'getInstructors']);
        Route::post('search-instructors', [AdminController::class, 'searchInstructors']);
        Route::post('students', [AdminController::class, 'getStudents']);
        Route::post('search-students', [AdminController::class, 'searchStudents']);
        Route::post('add-course', [AdminController::class, 'addCourse']);
        Route::post('delete-course', [AdminController::class, 'deleteCourse']);
        Route::post('enroll', [AdminController::class, 'enrollStudent']);
        Route::post('un-enroll', [AdminController::class, 'unEnrollStudent']);

    }); 
});

