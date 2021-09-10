<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PerformanceReviewResource;
use App\Models\PerformanceReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPerformanceReviewController extends Controller
{
    public function index(){
        if (Auth::user()->cannot('ViewAny',PerformanceReview::class)){
            return response()->json(['error'=>'Not Authorized'],403);
        }
        $performanceReviews = PerformanceReview::with(['reviewees'])->latest()->get();

        return PerformanceReviewResource::collection($performanceReviews);
    }
    public function store(Request $request){
       if (Auth::user()->cannot('create',PerformanceReview::class)){
           return response()->json(['error'=>'Not Authorized'],403);
       }
        $performanceReview = PerformanceReview::create($request->all());

       return new PerformanceReviewResource($performanceReview);
    }
   public function show(PerformanceReview $PerformanceReview){

       if (Auth::user()->cannot('view',$PerformanceReview)){
           return response()->json(['error'=>'Not Authorized'],403);
       }
       $PerformanceReview->load(['reviewees'=>function($query)use($PerformanceReview){
           $query->latest()->with(['reviewers'=>function($innerQuery)use($PerformanceReview){
               $innerQuery->latest()->where('performance_reviews_reviewees_reviewers.performance_id',$PerformanceReview->id);
           }]);
       }]);
       return new PerformanceReviewResource($PerformanceReview);
   }
   public function update(Request $request,PerformanceReview $PerformanceReview){
       if (Auth::user()->cannot('update',$PerformanceReview)){
           return response()->json(['error'=>'Not Authorized'],403);
       }
       $PerformanceReview->update($request->all());
       return new PerformanceReviewResource($PerformanceReview);
   }
   public function destroy(PerformanceReview $PerformanceReview){
       $PerformanceReview->delete();
       return response()->json(['Message' => 'PerformanceReview Deleted Successfully'],200);
   }

}
