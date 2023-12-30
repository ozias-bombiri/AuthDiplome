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

    public function findByInstitutionAndCategorie($institution_id, $categorie)
    {
        return Numeroteur::where('institution_id', '=', $institution_id)
                            ->where('categorieActe_id', '=', $categorie)
                            ->first();
    }

    public function findByIesr($iesr_id)
    {
        return Numeroteur::join('institutions', 'numeroteurs.institution_id', '=', 'institutions.id')
                            ->where('institutions.parent_id', '=', $iesr_id)
                            ->get();
    }

    public function findByEtablissement($etablissement_id)
    {
        return Numeroteur::where('institution_id', '=', $etablissement_id)
                            ->get();
    }
}
