<?php

namespace App\Policies;

use App\Models\Timbre;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TimbrePolicy
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
    public function view(User $user, Timbre $timbre): bool
    {
        return $user->hasRole(['admin', 'superAdmin']) || $user->institution_id === $timbre->institution_id;
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
    public function update(User $user, Timbre $timbre): bool
    {
        return $user->hasRole(['admin', 'superAdmin']) || $user->institution_id === $timbre->institution_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Timbre $timbre): bool
    {
        return $user->hasRole(['admin', 'superAdmin']) || $user->institution_id === $timbre->institution_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Timbre $timbre): bool
    {
        return $user->hasRole(['superAdmin']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Timbre $timbre): bool
    {
        return $user->hasRole(['superAdmin']);
    }
}
