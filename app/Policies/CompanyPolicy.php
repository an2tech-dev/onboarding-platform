<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Company;

class CompanyPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasRole('Administrator') || $user->hasRole('Manager');
    }

    public function view(User $user, Company $company)
    {
        return $user->hasRole('Administrator') || ($user->hasRole('Manager') && $user->company_id === $company->id);
    }

    public function create(User $user)
    {
        return $user->hasRole('Administrator');
    }

    public function update(User $user, Company $company)
    {
        return $user->hasRole('Administrator') || ($user->hasRole('Manager') && $user->company_id === $company->id);
    }

    public function delete(User $user, Company $company)
    {
        return $user->hasRole('Administrator');
    }
}
