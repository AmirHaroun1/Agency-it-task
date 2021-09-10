<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PerformanceReviewResource;
use App\Models\PerformanceReview;
use Illuminate\Http\Request;

class AdminPerformanceReviewRevieweeReviewerController extends Controller
{
    public function store(PerformanceReview $PerformanceReview,$reviewee_id,$reviewer_id){
        $PerformanceReview->reviewees()->updateExistingPivot($reviewee_id,['reviewer_id'=>$reviewer_id]);

        $PerformanceReview->load(['reviewees' => function($OuterQuery)use($reviewee_id,$reviewer_id,$PerformanceReview){
            $OuterQuery->latest()
                ->where('performance_reviews_reviewees_reviewers.reviewee_id',$reviewee_id)
                ->with(['reviewers'=>function($innerQuery)use($PerformanceReview){
                        $innerQuery->latest()->where('performance_reviews_reviewees_reviewers.performance_id',$PerformanceReview->id);
                }]);
        }]);
        return new PerformanceReviewResource($PerformanceReview);
    }
}
