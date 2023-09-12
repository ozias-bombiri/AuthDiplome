<?php

namespace App\Repositories;

use App\Models\DemandeAuthentification;
use App\Repositories\BaseRepository;

/**
 * Class DemandeAthentificationRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class DemandeAuthentificationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'reference',
		'reponse',
		'dateDemande',
		'demandeur',
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
        return DemandeAuthentification::class;
    }
}
