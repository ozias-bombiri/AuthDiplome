<?php

namespace App\Repositories;

use App\Models\AttestationProvisoire;
use App\Repositories\BaseRepository;

/**
 * Class AttestationProvisoireRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class AttestationProvisoireRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'reference',
        'intitule',
        'dateSignature',
        'dateCreation',
        'statutGeneration'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AttestationProvisoire::class;
    }

    public function findByInstitution($institution_id){
        $attestations = AttestationProvisoire::join('resultat_academiques', 'attestation_provisoires.resultat_academique_id', '=', 'resultat_academiques.id')
                		->join('parcours', 'resultat_academiques.parcours_id', '=', 'parcours.id')
                        ->where('parcours.institution_id', '=', $institution_id)
                        ->select('attestation_provisoires.*')
                        ->get();

        return $attestations;
        
    }

    public function findByNiveauParcoursAnnee($niveau,  $parcours, $annee){
        $attestations = AttestationProvisoire::join('resultat_academiques', 'attestation_provisoires.resultatAcademique_id', '=', 'resultat_academiques.id')
                		->join('parcours', 'resultat_academiques.parcours_id', '=', 'parcours.id')
                        ->where('parcours.niveauEtude_id', '=', $niveau)
                        ->where('parcours.id', '=', $parcours)
                        ->where('resultat_academiques.anneeAcademique_id', '=', $annee)
                        ->select('attestation_provisoires.*')
                        ->get();

        return $attestations;
        
    }

    public function findByReference($reference){
        $attestation = AttestationProvisoire::where('reference', '=', $reference)
                        ->first();
        return $attestation;
    }
}
