<?php

namespace App\Repositories;

use App\Models\SignataireActe;
use App\Repositories\BaseRepository;

/**
 * Class SignataireActeRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class SignataireActeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'signataire_id',
		'institution_id',
		'statut',
		'debut',
		'fin',
		'fonction',
		'mention'
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
        return SignataireActe::class;
    }

    public function findByInstitution($institution_id)
    {
        $signatairesActes = SignataireActe::join('institutions', 'signataire_actes.institution_id', '=', 'institution.id')
        ->where('institutions.id', $institution_id)
        ->select('signataire_actes.*')
        ->get();

        return $signatairesActes;
    }
}
