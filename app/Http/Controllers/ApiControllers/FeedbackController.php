<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PerformanceReviewResource;
use App\Models\PerformanceReview;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    //
    public function index(){

    $PerformanceReviews = PerformanceReview::join('performance_reviews_reviewees_reviewers','performance_reviews_reviewees_reviewers.performance_id','=','performance_reviews.id')
                                ->select('performance_reviews.*')
                                ->where('performance_reviews_reviewees_reviewers.reviewer_id',Auth::id())
                                ->paginate(10);
      $PerformanceReviews->load(['reviewees'=>function($query){
          $query->where('performance_reviews_reviewees_reviewers.reviewer_id',Auth::id());
      }]);
      return PerformanceReviewResource::collection($PerformanceReviews);
    }
    public function store(Request $request,PerformanceReview $PerformanceReview,$reviewee_id){
        $response = Gate::inspect('add-feedback',[$PerformanceReview,$reviewee_id]);
        if (!$response->allowed()){
            return response()->json(['Error'=>$response->message()],403);
        }
        $PerformanceReview->reviewees()->updateExistingPivot($reviewee_id,['feedback'=>$request->feedback,'status'=>1]);
        $PerformanceReview->load(['reviewees' => function($OuterQuery)use($reviewee_id,$PerformanceReview){
            $OuterQuery->latest()
                ->where('performance_reviews_reviewees_reviewers.reviewee_id',$reviewee_id)
                ->with(['reviewers'=>function($innerQuery)use($PerformanceReview){
                    $innerQuery->latest()->where('performance_reviews_reviewees_reviewers.performance_id',$PerformanceReview->id);
                }]);
        }]);
        return new PerformanceReviewResource($PerformanceReview);
    }
}
