<?php

namespace App\Policies;

use App\Models\Parcours;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ParcoursPolicy
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
    public function view(User $user, Parcours $parcours): bool
    {
        $institution = $parcours->institution;
        return $user->hasRole(['admin', 'superAdmin']) || 
            $user->institution_id === $parcours->institution_id || 
            $user->institution_id === $institution->parent_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(['direction', 'admin', 'superAdmin']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Parcours $parcours): bool
    {
        return $user->hasRole(['admin', 'superAdmin']) || $user->institution_id === $parcours->institution_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Parcours $parcours): bool
    {
        return $user->hasRole(['admin', 'superAdmin']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Parcours $parcours): bool
    {
        return $user->hasRole(['superAdmin']) ;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Parcours $parcours): bool
    {
        return $user->hasRole(['superAdmin']);
    }
}
