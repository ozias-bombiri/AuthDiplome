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
		'nevers',
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

    public function findByIdentifiant($identifiant){
        $impetrant = Etudiant::where('etudiants.identifiant', '=', $identifiant)->first();
        return $impetrant;
        
    }
    public function findByEtablissement($institution_id){
        $impetrants = Etudiant::join('inscriptions', 'inscriptions.etudiant_id', '=', 'etudiants.id')
                        ->join('parcours', 'inscriptions.parcours_id', '=', 'parcours.id')
                        ->join('filieres', 'parcours.filiere_id', '=', 'filieres.id')
                		->where('filieres.institution_id', '=', $institution_id)
                        ->select('etudiants.*')
                        ->get();
        return $impetrants;
        
    }

    public function findByIesr($iesr_id){
        $impetrants = Etudiant::join('inscriptions', 'inscriptions.etudiant_id', '=', 'etudiants.id')
                        ->join('parcours', 'inscriptions.parcours_id', '=', 'parcours.id')
                        ->join('filieres', 'parcours.filiere_id', '=', 'filieres.id')
                        ->join('institutions', 'filieres.institution_id', '=', 'institutions.id')
                		->where('institutions.parent_id', '=', $iesr_id)
                        ->select('etudiants.*')
                        ->get();
        return $impetrants;
        
    }
}
