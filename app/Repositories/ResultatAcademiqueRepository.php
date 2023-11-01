<?php

namespace App\Repositories;

use App\Models\ResultatAcademique;
use App\Repositories\BaseRepository;

/**
 * Class ResultatAcademiqueRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class ResultatAcademiqueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'reference',
		'soutenance',
		'dateSignaure',
		'moyenne',
		'cote',
		'session',
		'dateSoutenance',
		'impetrant_id',
		'parcours_id',
		'anneeAcademique_id',
		'document_id'
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
        return ResultatAcademique::class;
    }
}
