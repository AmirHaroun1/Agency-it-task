<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PerformanceReviewResource;
use App\Models\PerformanceReview;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPerformanceReviewRevieweeController extends Controller
{
    public function store(PerformanceReview $performanceReview,User $user){
        $performanceReview->reviewees()->attach($user->id);

        return new PerformanceReviewResource($performanceReview);
    }
}
