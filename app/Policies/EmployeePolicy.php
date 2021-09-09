<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization;

    public function create(User $user){
        return $user->IsAdmin();
    }
    public function viewAny(User $user){
        return $user->IsAdmin();
    }
    public function update(User $user,User $employee){
        return $user->IsAdmin();
    }
    public function view(User $user,User $employee){
        return $user->IsAdmin();
    }
    public function delete(User $user,User $employee){
        return $user->IsAdmin();
    }
}
