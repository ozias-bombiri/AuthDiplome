<?php

namespace App\Repositories;

use App\Models\Etablissement;
use App\Repositories\BaseRepository;

/**
 * Class EtablissementRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class EtablissementRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'sigle',
		'denomination',
		'telephone',
		'adresse',
		'email',
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

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Etablissement::class;
    }
}
