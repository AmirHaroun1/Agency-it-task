<?php

namespace App\Policies;

use App\Models\PerformanceReview;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PerformanceReviewPolicy
{
    use HandlesAuthorization;

    public function create(User $user){
        return $user->IsAdmin();
    }
    public function viewAny(User $user){
        return $user->IsAdmin();
    }
    public function update(User $user,PerformanceReview $performanceReview){
        return $user->IsAdmin();
    }
    public function view(User $user,PerformanceReview $performanceReview){
        return $user->IsAdmin();
    }
    public function delete(User $user,PerformanceReview $performanceReview){
        return $user->IsAdmin();
    }
}
