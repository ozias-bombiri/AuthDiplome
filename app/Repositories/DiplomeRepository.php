<?php

namespace App\Repositories;

use App\Models\Diplome;
use App\Repositories\BaseRepository;

/**
 * Class DiplomeRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class DiplomeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'reference',
        'intitule',
        'numeroEnregistremet',
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
        return Diplome::class;
    }

    public function findByReference($reference){
        $attestation = Diplome::where('reference', '=', $reference)
                        ->first();
        return $attestation;        
    }
}
