<?php

namespace App\Repositories;

use App\Models\NiveauEtude;
use App\Repositories\BaseRepository;

/**
 * Class NiveauEtudeRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class NiveauEtudeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'intitule',
        'description'
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
        return NiveauEtude::class;
    }
}
