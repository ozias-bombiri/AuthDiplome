<?php

namespace App\Repositories;

use App\Models\AttestationDefinitive;
use App\Repositories\BaseRepository;

/**
 * Class AttestationDefinitiveRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class AttestationDefinitiveRepository extends BaseRepository
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
        return AttestationDefinitive::class;
    }

    public function findByEtablissement($institution_id){
        $attestations = AttestationDefinitive::join('resultat_academiques', 'attestation_definitives.resultatAcademique_id', '=', 'resultat_academiques.id')
                		->join('parcours', 'resultat_academiques.parcours_id', '=', 'parcours.id')
                        ->join('filieres', 'parcours.filiere_id', '=', 'filieres.id')
                        ->where('filieres.institution_id', '=', $institution_id)
                        ->select('attestation_definitive.*')
                        ->get();

        return $attestations;
        
    }

    public function findByIesr($iesr_id){
        $attestations = AttestationDefinitive::join('resultat_academiques', 'attestation_definitives.resultatAcademique_id', '=', 'resultat_academiques.id')
                		->join('parcours', 'resultat_academiques.parcours_id', '=', 'parcours.id')
                        ->join('filieres', 'parcours.filiere_id', '=', 'filieres.id')
                        ->join('institutions', 'filieres.institution_id', '=', 'institutions.id')
                        ->where('institutions.parent_id', '=', $iesr_id)
                        ->select('attestation_definitives.*')
                        ->get();

        return $attestations;
        
    }

    public function findByNiveau($niveau){
        $attestations = AttestationDefinitive::join('resultat_academiques', 'attestation_definitives.resultatAcademique_id', '=', 'resultat_academiques.id')
                		->join('parcours', 'resultat_academiques.parcours_id', '=', 'parcours.id')
                        ->where('parcours.niveauEtude_id', '=', $niveau)
                        ->select('attestation_definitives.*')
                        ->get();

        return $attestations;
        
    }

    public function findByNiveauParcoursAnnee($niveau,  $parcours, $annee){
        $attestations = AttestationDefinitive::join('resultat_academiques', 'attestation_definitives.resultatAcademique_id', '=', 'resultat_academiques.id')
                		->join('parcours', 'resultat_academiques.parcours_id', '=', 'parcours.id')
                        ->where('parcours.niveauEtude_id', '=', $niveau)
                        ->where('parcours.id', '=', $parcours)
                        ->where('resultat_academiques.anneeAcademique_id', '=', $annee)
                        ->select('attestation_definitive.*')
                        ->get();

        return $attestations;
        
    }

    public function findByReference($reference){
        $attestation = AttestationDefinitive::where('reference', '=', $reference)
                        ->first();
        return $attestation;        
    }
}
