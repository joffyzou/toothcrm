<?php

namespace App\Policies;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Patient $patient)
    {
        return $user->is_admin || $user->id === $patient->user_id;
    }
}
