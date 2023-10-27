<?php

namespace App\Policies;

use App\Models\Impetrant;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ImpetrantPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Impetrant $impetrant): bool
    {
        return true ;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(['direction', 'admin', 'superAdmin']) ;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Impetrant $impetrant): bool
    {
        return $user->hasRole(['direction', 'admin', 'superAdmin']) ;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Impetrant $impetrant): bool
    {
        return $user->hasRole(['admin', 'superAdmin']) ;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Impetrant $impetrant): bool
    {
        return $user->hasRole(['superAdmin']) ;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Impetrant $impetrant): bool
    {
        return $user->hasRole(['superAdmin']) ;
    }
}
