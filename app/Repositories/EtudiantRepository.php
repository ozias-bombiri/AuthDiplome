<?php

namespace App\Repositories;

use App\Models\Etudiant;
use App\Repositories\BaseRepository;

/**
 * Class EtudiantRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class EtudiantRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'identifiant',
		'typeIdentifiant',
		'nom',
		'prenom',
		'sexe',
		'dateNaissance',
		'lieuNaissance',
		'paysNaissance'
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
        return Etudiant::class;
    }
}
