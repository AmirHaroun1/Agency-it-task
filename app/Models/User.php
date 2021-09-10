<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function IsAdmin(){
        return $this->is_admin;
    }
    /**
     * Many To Many Relationship.
     *
     * in case of User is Reviewee it allows him to get the reviewers
     */
    public function reviewers(){
        return $this->belongsToMany(User::class,'performance_reviews_reviewees_reviewers','reviewee_id','reviewer_id')
            ->withPivot(['feedback','status'])
            ->withTimestamps();
    }
    /**
     * Many To Many Relationship.
     *
     * in case of User is Reviewer it allows him to get the The Performance Reviews that he should review
     */
    public function PerformanceReviews(){
        return $this->belongsToMany(PerformanceReview::class,'performance_reviews_reviewees_reviewers','reviewer_id','performance_id')
            ->withPivot(['feedback','status'])
            ->withTimestamps();
    }
}
