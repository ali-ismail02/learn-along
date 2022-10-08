<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController; 


Route::group(['middleware' => 'auth:api'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::post('signUp', [UserController::class, 'signUp']);

Route::group(["middleware" => "JWT"], function(){
    Route::post('favorite', [UserController::class, 'addOrRemoveFavorite']);
}); 

