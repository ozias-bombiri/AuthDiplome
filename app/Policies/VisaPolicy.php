<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Visa;
use Illuminate\Auth\Access\Response;

class VisaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['admin', 'superAdmin']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Visa $visa): bool
    {
        return $user->hasRole(['daoi', 'admin', 'superAdmin']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(['admin', 'superAdmin']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Visa $visa): bool
    {
        return $user->hasRole(['admin', 'superAdmin']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Visa $visa): bool
    {
        return $user->hasRole(['admin', 'superAdmin']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Visa $visa): bool
    {
        return $user->hasRole(['superAdmin']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Visa $visa): bool
    {
        return $user->hasRole(['superAdmin']);
    }
}
