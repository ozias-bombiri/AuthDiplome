<?php

namespace App\Repositories;

use App\Models\AnneeAcademique;
use App\Repositories\BaseRepository;

/**
 * Class AnneeAcademiqueRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class AnneeAcademiqueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'intitule',
        'debut',
        'fin'
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
        return AnneeAcademique::class;
    }
}
