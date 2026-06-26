<?php

namespace App\Policies;

use App\Models\Certificate;
use App\Models\User;

class CertificatePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Certificate $certificate): bool
    {
        return $user->id === $certificate->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Certificate $certificate): bool
    {
        return $user->id === $certificate->user_id;
    }

    public function delete(User $user, Certificate $certificate): bool
    {
        return $user->id === $certificate->user_id;
    }
}
