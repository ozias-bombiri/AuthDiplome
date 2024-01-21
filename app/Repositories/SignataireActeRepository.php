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

    public function findByEtablissement($institution_id)
    {
        $signatairesActes = SignataireActe::join('institutions', 'signataires_actes.institution_id', '=', 'institutions.id')
        ->where('institutions.id', $institution_id)
        ->select('signataires_actes.*')
        ->get();

        return $signatairesActes;
    }

    public function findByIesr($iesr_id)
    {
        $signatairesActes = SignataireActe::join('institutions', 'signataires_actes.institution_id', '=', 'institutions.id')
        ->where('institutions.parent_id', $iesr_id)
        ->select('signataires_actes.*')
        ->get();

        return $signatairesActes;
    }

    public function findByInstitutionAndStatut($institution_id, $statut)
    {
        $signatairesActes = SignataireActe::join('institutions', 'signataires_actes.institution_id', '=', 'institutions.id')
        ->where('institutions.id', $institution_id)
        ->where('signataires_actes.statut', $statut)
        ->select('signataires_actes.*')
        ->get();

        return $signatairesActes;
    }

    public function findByActiveInstitution($institution_id)
    {
        $signatairesActe = SignataireActe::join('institutions', 'signataires_actes.institution_id', '=', 'institutions.id')
        ->where('institutions.id', $institution_id)
        ->where('signataires_actes.statut', 1)
        ->select('signataires_actes.*')
        ->first();

        return $signatairesActe;
    }

    public function findByActiveInstitutionAndCategorieActe($institution_id, $categorie_id)
    {
        $signataireActe = SignataireActe::join('institutions', 'signataires_actes.institution_id', '=', 'institutions.id')
        ->where('institutions.id', $institution_id)
        ->where('signataires_actes.categorieActe_id', $categorie_id)
        ->where('signataires_actes.statut', 1)
        ->select('signataires_actes.*')
        ->first();

        return $signataireActe;
    }

    public function findByInstitutionAndCategorie($institution_id, $categorie_id)
    {
        $signataireActe = SignataireActe::join('institutions', 'signataires_actes.institution_id', '=', 'institutions.id')
        ->where('institutions.id', $institution_id)
        ->where('signataires_actes.categorieActe_id', $categorie_id)
        ->select('signataires_actes.*')
        ->get();

        return $signataireActe;
    }
}


