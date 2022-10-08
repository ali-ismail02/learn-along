<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController; 


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group(['prefix' => 'admin'], function () {
    Route::group(["middleware" => "JWT"], function(){
        Route::post('register', [UserController::class, 'register']);
        Route::post('delete-user', [UserController::class, 'deleteUser']);
        Route::post('add-course', [UserController::class, 'addCourse']);
        Route::post('delete-course', [UserController::class, 'deleteCourse']);
        Route::post('enroll', [UserController::class, 'enrollStudent']);
    }); 
});

