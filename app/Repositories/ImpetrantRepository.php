<?php

namespace App\Repositories;

use App\Models\Impetrant;
use App\Repositories\BaseRepository;

/**
 * Class ImpetrantRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class ImpetrantRepository extends BaseRepository
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
        return Impetrant::class;
    }

    public function findByIdentifiant($identifiant){
        $impetrant = Impetrant::where('impetrants.identifiant', '=', $identifiant)->first();
        return $impetrant;
        
    }
    public function findByEtablissement($institution_id){
        $impetrants = Impetrant::join('inscriptions', 'inscriptions.impetrant_id', '=', 'impetrants.id')
                        ->join('parcours', 'inscriptions.parcours_id', '=', 'parcours.id')
                        ->join('filieres', 'parcours.filiere_id', '=', 'filieres.id')
                		->where('filieres.institution_id', '=', $institution_id)
                        ->select('impetrants.*')
                        ->get();
        return $impetrants;
        
    }

    public function findByIesr($iesr_id){
        $impetrants = Impetrant::join('inscriptions', 'inscriptions.impetrant_id', '=', 'impetrants.id')
                        ->join('parcours', 'inscriptions.parcours_id', '=', 'parcours.id')
                        ->join('filieres', 'parcours.filiere_id', '=', 'filieres.id')
                        ->join('institutions', 'filieres.institution_id', '=', 'institution.id')
                		->where('institutions.parent_id', '=', $iesr_id)
                        ->select('impetrants.*')
                        ->get();
        return $impetrants;
        
    }
}
