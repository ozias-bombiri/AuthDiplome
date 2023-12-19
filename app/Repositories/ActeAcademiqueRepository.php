<?php

namespace App\Repositories;

use App\Models\ActeAcademique;
use App\Repositories\BaseRepository;

/**
 * Class ActeAcademiqueRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class ActeAcademiqueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'intitule',
		'numero',
		'dateSignature',
		'lieu',
		'statutSignature',
		'statutRemise',
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
        return ActeAcademique::class;
    }

    public function findByEtablissement($institution_id){
        $attestations = ActeAcademique::join('resultat_academiques', 'actes_academiques.resultatAcademique_id', '=', 'resultat_academiques.id')
                		->join('parcours', 'resultat_academiques.parcours_id', '=', 'parcours.id')
                        ->join('filieres', 'parcours.filiere_id', '=', 'filieres.id')
                        ->where('filieres.institution_id', '=', $institution_id)
                        ->select('actes_academiques.*')
                        ->get();

        return $attestations;
        
    }

    public function findByIesr($iesr_id){
        $attestations = ActeAcademique::join('resultat_academiques', 'actes_academiques.resultatAcademique_id', '=', 'resultat_academiques.id')
                		->join('parcours', 'resultat_academiques.parcours_id', '=', 'parcours.id')
                        ->join('filieres', 'parcours.filiere_id', '=', 'filieres.id')
                        ->join('institutions', 'filieres.institution_id', '=', 'institutions.id')
                        ->where('institution.parent_id', '=', $iesr_id)
                        ->select('actes_academiques.*')
                        ->get();

        return $attestations;
        
    }

    public function findByNiveau($niveau){
        $attestations = ActeAcademique::join('resultat_academiques', 'actes_academiques.resultatAcademique_id', '=', 'resultat_academiques.id')
                		->join('parcours', 'resultat_academiques.parcours_id', '=', 'parcours.id')
                        ->where('parcours.niveauEtude_id', '=', $niveau)
                        ->select('actes_academiques.*')
                        ->get();

        return $attestations;
        
    }

    public function findByNiveauParcoursAnnee($niveau,  $parcours, $annee){
        $attestations = ActeAcademique::join('resultat_academiques', 'actes_academiques.resultatAcademique_id', '=', 'resultat_academiques.id')
                		->join('parcours', 'resultat_academiques.parcours_id', '=', 'parcours.id')
                        ->where('parcours.niveauEtude_id', '=', $niveau)
                        ->where('parcours.id', '=', $parcours)
                        ->where('resultat_academiques.anneeAcademique_id', '=', $annee)
                        ->select('actes_academiques.*')
                        ->get();

        return $attestations;
        
    }

    public function findByReference($reference){
        $attestation = ActeAcademique::where('reference', '=', $reference)
                        ->first();
        return $attestation;
    }
}