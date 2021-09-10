<?php


use App\Http\Controllers\ApiControllers\AdminEmployeeController;
use App\Http\Controllers\ApiControllers\AdminPerformanceReviewController;
use App\Http\Controllers\ApiControllers\AdminPerformanceReviewRevieweeController;
use App\Http\Controllers\ApiControllers\AdminPerformanceReviewRevieweeReviewerController;
use App\Http\Controllers\ApiControllers\Auth\LoginController;
use App\Http\Controllers\ApiControllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'v1.0'],function(){

    Route::post('/login',[LoginController::class,'login']);

    Route::group(['middleware'=>'auth:sanctum'],function(){
        Route::get('/logout',[LogoutController::class,'logout']);

        Route::group(['as'=>'admin.'],function(){
                Route::apiResource('/Admin/Employees',AdminEmployeeController::class);
                Route::apiResource('/Admin/PerformanceReview',AdminPerformanceReviewController::class);
                Route::post('/Admin/PerformanceReviews/{PerformanceReview}/Reviewee/{Reviewee}',[AdminPerformanceReviewRevieweeController::class,'store']);
                Route::post('/Admin/PerformanceReviews/{PerformanceReview}/Reviewee/{Reviewee_id}/Reviewer/{Reviewer_id}',[AdminPerformanceReviewRevieweeReviewerController::class,'store']);
        });
    });

});
