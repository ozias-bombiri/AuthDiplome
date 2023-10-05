<?php

namespace App\Repositories;

use App\Models\Institution;
use App\Repositories\BaseRepository;

/**
 * Class InstitutionRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class InstitutionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'sigle',
        'parent_id',
		'denomination',
		'telephone',
		'adresse',
		'email',
        'siteWeb',
		'type',
		'logo',
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

    public function findByType($type)
    {
        return Institution::where('type', $type)->get();
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Institution::class;
    }
}
