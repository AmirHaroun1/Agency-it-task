<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PerformanceReviewResource;
use App\Models\PerformanceReview;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPerformanceReviewRevieweeController extends Controller
{
    public function store(PerformanceReview $PerformanceReview,User $user){
        $PerformanceReview->reviewees()->attach($user->id);
        $PerformanceReview->load(['reviewees'=>function($query)use($PerformanceReview){
            $query->latest()->with(['reviewers'=>function($innerQuery)use($PerformanceReview){
                $innerQuery->latest()->where('performance_reviews_reviewees_reviewers.performance_id',$PerformanceReview->id);
            }]);
        }]);
        return new PerformanceReviewResource($PerformanceReview);
    }
}
