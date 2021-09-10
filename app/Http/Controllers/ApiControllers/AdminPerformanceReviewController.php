<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\PerformanceReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPerformanceReviewController extends Controller
{
    //
   public function store(Request $request){
       if (Auth::user()->cannot('create',PerformanceReview::class)){
           return response()->json(['error'=>'Not Authorized'],403);
       }
       PerformanceReview::create($request->all());
   }
   public function show(PerformanceReview $performanceReview){
       if (Auth::user()->cannot('view',$performanceReview)){
           return response()->json(['error'=>'Not Authorized'],403);
       }
   }
   public function update(Request $request,PerformanceReview $performanceReview){
       if (Auth::user()->cannot('update',PerformanceReview::class)){
           return response()->json(['error'=>'Not Authorized'],403);
       }
       $performanceReview->update($request->all());
   }
   public function destroy(PerformanceReview $performanceReview){
       $performanceReview->delete();
   }

}
