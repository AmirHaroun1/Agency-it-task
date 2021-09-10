<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\PerformanceReview;
use Illuminate\Http\Request;

class AdminPerformanceReviewRevieweeReviewerController extends Controller
{
    public function store(PerformanceReview $performanceReview,$reviewee_id,$reviewer_id){
        $performanceReview->reviewees()->updateExistingPivot($reviewee_id,['reviewer_id'=>$reviewer_id]);

        $performanceReview->load(['reviewees' => function($OuterQuery)use($reviewee_id,$reviewer_id){
            $OuterQuery->latest()
                ->where('performance_reviews_reviewees_reviewers.reviewee_id',$reviewee_id)
                ->with(['reviewers'=>function($innerQuery){
                        $innerQuery->latest();
                }]);
        }]);
    }
}
