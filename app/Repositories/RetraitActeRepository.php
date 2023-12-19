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
    public function findByInstitution($institution_id)
    {
        return RetraitActe::join('acte_academiques', 'retrait_actes.filiere_id', '=', 'acte_academiques.id')
                ->join('institutions', 'filieres.institution_id', '=', 'institutions.id')
                ->where('institutions.id', $institution_id)
                ->select('retrait_actes.*')
                ->get();
    }

    
}
