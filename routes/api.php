<?php


use App\Http\Controllers\ApiControllers\AdminEmployeeController;
use App\Http\Controllers\ApiControllers\AdminPerformanceReviewController;
use App\Http\Controllers\ApiControllers\AdminPerformanceReviewRevieweeController;
use App\Http\Controllers\ApiControllers\AdminPerformanceReviewRevieweeReviewerController;
use App\Http\Controllers\ApiControllers\Auth\LoginController;
use App\Http\Controllers\ApiControllers\Auth\LogoutController;
use App\Http\Controllers\ApiControllers\FeedbackController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'v1.0'],function(){

    Route::post('/login',[LoginController::class,'login']);

    Route::group(['middleware'=>'auth:sanctum'],function(){
        Route::get('/logout',[LogoutController::class,'logout']);

        Route::group(['as'=>'admin.','prefix'=>'Admin'],function(){
                Route::apiResource('/Employees',AdminEmployeeController::class);
                Route::apiResource('//PerformanceReview',AdminPerformanceReviewController::class);
                Route::post('/PerformanceReviews/{PerformanceReview}/Reviewee/{Reviewee}',[AdminPerformanceReviewRevieweeController::class,'store'])->middleware('AssignReviewee');
                Route::post('/PerformanceReviews/{PerformanceReview}/Reviewee/{Reviewee_id}/Reviewer/{Reviewer_id}',[AdminPerformanceReviewRevieweeReviewerController::class,'store']);
        });
        Route::get('/FeedBacks',[FeedbackController::class,'index']);
        Route::post('/FeedBacks/PerformanceReviews/{PerformanceReview}/Reviewee/{Reviewee_id}',[FeedbackController::class,'store']);
    });

});
