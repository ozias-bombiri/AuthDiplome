<?php

namespace App\Repositories;

use App\Models\VisaDiplome;
use App\Repositories\BaseRepository;

/**
 * Class VisaDiplomeRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class VisaDiplomeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'visa_id',
		'visaInstitution_id',
		'ordre'
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
        return VisaDiplome::class;
    }
}
