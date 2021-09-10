<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\PerformanceReview;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPerformanceReviewRevieweeController extends Controller
{
    public function store(User $user,PerformanceReview $performanceReview){
        $performanceReview->reviewees()->attach($user->id);
    }
}
