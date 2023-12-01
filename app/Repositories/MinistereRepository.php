<?php

namespace App\Repositories;

use App\Models\Ministere;
use App\Repositories\BaseRepository;

/**
 * Class MinistereRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class MinistereRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'denomination',
        'sigle',
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
        return Ministere::class;
    }
}
