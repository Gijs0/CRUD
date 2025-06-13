<?php

namespace App\Policies;

use App\Models\Festival;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FestivalPolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user)
    {
        return true;
    }

    public function view(?User $user, Festival $festival)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, Festival $festival)
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, Festival $festival)
    {
        return $user->hasRole('admin');
    }

    public function restore(User $user, Festival $festival)
    {
        return $user->hasRole('admin');
    }

    public function forceDelete(User $user, Festival $festival)
    {
        return $user->hasRole('admin');
    }
} 