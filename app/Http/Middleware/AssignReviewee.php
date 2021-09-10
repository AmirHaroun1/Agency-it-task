<?php

namespace App\Http\Middleware;

use App\Models\PerformanceReview;
use Closure;
use Illuminate\Http\Request;

class AssignReviewee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
         $PerformanceReview = $request->route('PerformanceReview');
        if ($PerformanceReview->has('reviewees',$request->route('reviewee'))){
            return response()->json(['Message'=>'This Reviewee Is Already Added To The Performance Review'],200);
        }
        return $next($request);
    }
}
