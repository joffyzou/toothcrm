<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function isAdmin(User $currentUser)
    {
        return $currentUser->is_admin && $currentUser->id === 1;
    }

    public function update(User $currentUser)
    {
        return $currentUser->is_admin || $currentUser->role_id === 1;
    }
}
