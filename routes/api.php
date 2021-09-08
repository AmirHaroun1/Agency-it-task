<?php

use App\Http\Controllers\ApiControllers\Auth\LoginController;
use App\Http\Controllers\ApiControllers\Auth\LogoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'/api/v1'],function(){

    Route::post('/login',[LoginController::class,'login']);
    Route::get('/logout',[LogoutController::class,'logout']);

    Route::group(['middleware'=>'auth:sanctum'],function(){

    });

});
