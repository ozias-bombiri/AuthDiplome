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
}
