<?php

namespace App\Repositories;

use App\Models\RetraitActe;
use App\Repositories\BaseRepository;

/**
 * Class RetraitActeRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class RetraitActeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'reference',
		'dateRetrait',
		'retirant',
		'description',
		'acteAcademique_id',
		'user_id'
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
        return RetraitActe::class;
    }

    /**
     * Selectionner les parcours d'une institution
     **/
    public function findByEtablissementAndCategorie($institution_id, $categorie_id)
    {
        return RetraitActe::join('acte_academiques', 'retrait_actes.acteAcademique_id', '=', 'acte_academiques.id')
                ->join('resultat_academiques', 'acte_academiques.resultatAcademique_id', '=', 'resultat_academiques.id')
                ->join('proces_verbaux', 'resultat_academiques.procesVerbal_id', '=', 'proces_verbaux.id')
                ->join('parcours', 'proces_verbaux.parcours_id', '=', 'parcours.id')
                ->join('filieres', 'parcours.filiere_id', '=', 'filieres.id')
                ->join('institutions', 'filieres.institution_id', '=', 'institutions.id')
                ->where('institutions.id', $institution_id)
                ->where('acte_academiques.categorieActe_id', $categorie_id)
                ->select('retrait_actes.*')
                ->get();
    }

    /**
     * Selectionner les parcours d'une institution
     **/
    public function findByIesrAndCategorie($institution_id, $categorie_id)
    {
        return RetraitActe::join('acte_academiques', 'retrait_actes.acteAcademique_id', '=', 'acte_academiques.id')
        ->join('resultat_academiques', 'acte_academiques.resultatAcademique_id', '=', 'resultat_academiques.id')
        ->join('proces_verbaux', 'resultat_academiques.procesVerbal_id', '=', 'proces_verbaux.id')
        ->join('parcours', 'proces_verbaux.parcours_id', '=', 'parcours.id')
        ->join('filieres', 'parcours.filiere_id', '=', 'filieres.id')
        ->join('institutions', 'filieres.institution_id', '=', 'institutions.id')
        ->where('institutions.parent_id', $institution_id)
        ->where('acte_academiques.categorieActe_id', $categorie_id)
        ->select('retrait_actes.*')
        ->get();
    }

    
}
