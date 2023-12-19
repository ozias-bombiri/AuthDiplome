<?php

namespace App\Repositories;

use App\Models\VisaInstitution;
use App\Repositories\BaseRepository;

/**
 * Class VisaInstitutionRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class VisaInstitutionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'categorieActe_id',
		'institution_id',
		'intitule'
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
        return VisaInstitution::class;
    }
}
