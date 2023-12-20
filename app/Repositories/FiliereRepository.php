<?php

namespace App\Repositories;

use App\Models\Filiere;
use App\Repositories\BaseRepository;

/**
 * Class FiliereRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class FiliereRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'intitule',
		'sigle',
		'code',
		'description',
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
        return Filiere::class;
    }

    public function findByEtablissement($institution_id){
        $impetrants = Filiere::join('institutions', 'filieres.institution_id', '=', 'institutions.id')
                        ->where('institutions.id', '=', $institution_id)
                        ->select('filieres.*')
                        ->get();
        return $impetrants;
        
    }

    public function findByIesr($institution_id){
        $impetrants = Filiere::join('institutions', 'filieres.institution_id', '=', 'institutions.id')
                        ->where('institutions.parent_id', '=', $institution_id)
                        ->select('filieres.*')
                        ->get();
        return $impetrants;
        
    }
}
