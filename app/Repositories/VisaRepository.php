<?php

namespace App\Repositories;

use App\Models\Visa;
use App\Repositories\BaseRepository;

/**
 * Class VisaRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class VisaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'numero',
		'intitule',
		'datesignaure',
		'texte'
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
        return Visa::class;
    }
}
