<?php

namespace App\Repositories;

use App\Models\TimbresIesr;
use App\Repositories\BaseRepository;

/**
 * Class TimbresIesrRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class TimbreIesrRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'intitule',
		'type',
		'ministere',
		'denomMinistere',
		'description',
		'iesr_id'
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
        return TimbresIesr::class;
    }
}
