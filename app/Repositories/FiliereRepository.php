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
        'code',
        'sigle',
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
}
