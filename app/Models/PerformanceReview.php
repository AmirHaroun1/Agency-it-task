<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceReview extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function reviewees(){
        return $this->belongsToMany(User::class,'performance_reviews_reviewees_reviewers','performance_id','reviewee_id')
            ->withPivot(['created_at']);
    }
    public function reviewers(){
        return $this->belongsToMany(User::class,'performance_reviews_reviewees_reviewers','performance_id','reviewer_id')
            ->withPivot(['reviewee_id','feedback','status','created_at']);
    }
}
