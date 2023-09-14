<?php

namespace App\Repositories;

use App\Models\Iesr;
use App\Repositories\BaseRepository;

/**
 * Class IesrRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class IesrRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'sigle',
		'denomination',
		'telephone',
		'email',
		'adresse',
		'siteweb',
		'logo',
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
        return Iesr::class;
    }
}
