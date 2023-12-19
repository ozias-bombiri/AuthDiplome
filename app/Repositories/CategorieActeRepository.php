<?php

namespace App\Repositories;

use App\Models\CategorieActe;
use App\Repositories\BaseRepository;

/**
 * Class AttestationDefinitiveRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class CategorieActeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'intitule',
		'nombreCopies',
		'visas'
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
        return CategorieActe::class;
    }
}
