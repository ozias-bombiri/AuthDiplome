<?php

namespace App\Policies;

use App\Models\AttestationProvisoire;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AttestationProvisoirePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AttestationProvisoire $attestation): bool
    {
        //seul les utilisateurs de l'etablissement emetteur et ceux ayant le role admin ou authentification peuvent voir
        return ($user->hasRole(['admin', 'authentification']) or $user->institution->id === $attestation->signataire->institution_id );
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(['direction']) ;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AttestationProvisoire $attestationProvisoire): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AttestationProvisoire $attestationProvisoire): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AttestationProvisoire $attestationProvisoire): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AttestationProvisoire $attestationProvisoire): bool
    {
        //
    }
}
