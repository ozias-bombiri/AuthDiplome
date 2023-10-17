<?php

namespace App\Repositories;

use App\Models\Impetrant;
use App\Repositories\BaseRepository;

/**
 * Class ImpetrantRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class ImpetrantRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'identifiant',
		'typeIdentifiant',
		'nom',
		'prenom',
		'sexe',
		'dateNaissance',
		'lieuNaissance',
		'paysNaissance'
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
        return Impetrant::class;
    }

    public function findByInstitution($institution_id){
        $impetrants = Impetrant::join('institutions_impetrants', 'institutions_impetrants.impetrant_id', '=', 'impetrants.id')
                		->where('institutions_impetrants.institution_id', '=', $institution_id)
                        ->select('impetrants.*')
                        ->get();

        return $impetrants;
        
    }
}
