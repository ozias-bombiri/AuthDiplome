<?php

namespace App\Repositories;

use App\Models\TimbreEtablissement;
use App\Repositories\BaseRepository;

/**
 * Class TimbreEtablissementRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class TimbreEtablissementRepository extends BaseRepository
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
		'etablissement_id'
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
        return TimbreEtablissement::class;
    }
}
