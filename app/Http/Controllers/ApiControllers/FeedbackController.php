<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PerformanceReviewResource;
use App\Models\PerformanceReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    //
    public function index(){
      $PerformanceReviews =  PerformanceReview::with(['reviewees'=>function($query){
            $query->when(!Auth::user()->IsAdmin(),function()use($query){
                $query->where('performance_reviews_reviewees_reviewers.reviewer_id',Auth::id());
            });
        }])->paginate(10);
      return PerformanceReviewResource::collection($PerformanceReviews);
    }
    public function store(Request $request,PerformanceReview $PerformanceReview,$reviewee_id){

        $PerformanceReview->reviewees()->updateExistingPivot($reviewee_id,['feedback'=>$request->feedback,'status'=>1]);
        return response()->json(['Success'=>'FeedBack Added Successfully'],200);
    }
}
