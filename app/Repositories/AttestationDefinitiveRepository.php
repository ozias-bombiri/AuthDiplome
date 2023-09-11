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
}
