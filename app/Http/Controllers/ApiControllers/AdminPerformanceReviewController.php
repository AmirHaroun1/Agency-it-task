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
        $performanceReviews = PerformanceReview::with('reviewees')->paginate(10);

        return PerformanceReviewResource::collection($performanceReviews);
    }
    public function store(Request $request){
       if (Auth::user()->cannot('create',PerformanceReview::class)){
           return response()->json(['error'=>'Not Authorized'],403);
       }
        $performanceReview = PerformanceReview::create($request->all());

       return new PerformanceReviewResource($performanceReview);
    }
   public function show(PerformanceReview $performanceReview){
       if (Auth::user()->cannot('view',$performanceReview)){
           return response()->json(['error'=>'Not Authorized'],403);
       }
       $performanceReview->load('reviewees');

       return new PerformanceReviewResource($performanceReview);
   }
   public function update(Request $request,PerformanceReview $performanceReview){
       if (Auth::user()->cannot('update',PerformanceReview::class)){
           return response()->json(['error'=>'Not Authorized'],403);
       }
       $performanceReview->update($request->all());
       return new PerformanceReviewResource($performanceReview);
   }
   public function destroy(PerformanceReview $performanceReview){
       $performanceReview->delete();
       return response()->json(['Message' => 'PerformanceReview Deleted Successfully'],200);
   }

}
