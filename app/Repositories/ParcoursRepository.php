<?php

namespace App\Repositories;

use App\Models\Parcours;
use App\Repositories\BaseRepository;

/**
 * Class ParcoursRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class ParcoursRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'intitule',
		'soutenance',
		'domaine',
		'mention',
		'specialite',
		'description',
		'etablissement_id',
		'niveauEtude_id'
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
        return Parcours::class;
    }

    /**
     * Selectionner les parcours d'une institution
     **/
    public function findByInstitution($institution_id)
    {
        return Parcours::join('filieres', 'parcours.filiere_id', '=', 'filieres.id')
                ->join('institutions', 'filieres.institution_id', '=', 'institutions.id')
                ->where('institutions.id', $institution_id)
                ->select('parcours.*')
                ->get();
    }

    /**
     * Selectionner les parcours d'une institution
     **/
    public function findByIesr($iesr_id)
    {
        return Parcours::join('filieres', 'parcours.filiere_id', '=', 'filieres.id')
                ->join('institutions', 'filieres.institution_id', '=', 'institutions.id')
                ->where('institutions.parent_id', $iesr_id)
                ->select('parcours.*')
                ->get();
    }

    /**
     * Selectionner les parcours d'une institution
     **/
    public function findInstitution($id)
    {
        return Parcours::join('filieres', 'parcours.filiere_id', '=', 'filieres.id')
                ->join('institutions', 'filieres.institution_id', '=', 'institutions.id')
                ->where('parcours.id', $id)
                ->select('institutions.*')
                ->first();
    }
}
