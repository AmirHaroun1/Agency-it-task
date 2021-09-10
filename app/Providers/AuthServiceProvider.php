<?php

namespace App\Providers;

use App\Models\PerformanceReview;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Models\User' => 'App\Policies\EmployeePolicy',
         'App\Models\PerformanceReview' => 'App\Policies\PerformanceReviewPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('add-feedback', function (User $user, PerformanceReview $performanceReview,$reviewee_id) {
            $performanceReview = $performanceReview->reviewees()
                                    ->wherePivot('reviewee_id',$reviewee_id)
                                    ->wherePivot('reviewer_id',$user->id)
                                    ->first();
            if (!is_null($performanceReview) && !$user->IsAdmin()){
                $status = $performanceReview->pivot->status;
                if ($status == 1){
                    return Response::deny('FeedBack Cant be Resubmitted.');
                }
                return Response::allow();
            }
            return Response::deny("You Aren't The Reviewer");
        });
        //
    }
}
