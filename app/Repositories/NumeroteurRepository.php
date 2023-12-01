<?php

namespace App\Repositories;

use App\Models\Numeroteur;
use App\Repositories\BaseRepository;

/**
 * Class NumeroteurRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class NumeroteurRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'categorie',
		'compteur',
		'chaine',
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
        return Numeroteur::class;
    }

    public function findByInstitutionandCategorie($institution_id, $categorie)
    {
        return Numeroteur::where('institution_id', '=', $institution_id)
                            ->where('categorie', '=', $categorie)
                            ->first();
    }
}
