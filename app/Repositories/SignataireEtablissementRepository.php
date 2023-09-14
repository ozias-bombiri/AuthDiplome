<?php

namespace App\Repositories;

use App\Models\SignataireEtablissement;
use App\Repositories\BaseRepository;

/**
 * Class SignataireEtablissementRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class SignataireEtablissementRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nom',
		'prenom',
		'nip',
		'sexe',
		'typeDocument',
		'fonction',
		'fonctionLongue',
		'titreAcademique',
		'titreHonorifique',
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
        return SignataireEtablissement::class;
    }
}
