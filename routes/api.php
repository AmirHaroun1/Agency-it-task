<?php

use App\Http\Controllers\ApiControllers\Auth\LoginController;
use App\Http\Controllers\ApiControllers\Auth\LogoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'v1.0'],function(){

    Route::post('/login',[LoginController::class,'login']);

    Route::group(['middleware'=>'auth:sanctum'],function(){
        Route::get('/logout',[LogoutController::class,'logout']);

        Route::group(['middleware'=>'IsAdmin'],function(){

        });
    });

});
