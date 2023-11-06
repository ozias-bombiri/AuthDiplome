<?php

namespace App\Repositories;

use App\Models\ResultatAcademique;
use App\Repositories\BaseRepository;
use App\Models\Impetrant; 
use App\Models\AttestationProvisoire; 

/**
 * Class ResultatAcademiqueRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class ResultatAcademiqueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'reference',
		'soutenance',
		'dateSignaure',
		'moyenne',
		'cote',
		'session',
		'dateSoutenance',
		'impetrant_id',
		'parcours_id',
		'anneeAcademique_id',
		'document_id'
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
        return ResultatAcademique::class;
    }


    


    public function findByInstitution($institution_id){ 
        

        // $impetrants = Impetrant::join('institutions_impetrants', 'institutions_impetrants.impetrant_id', '=', 'impetrants.id')
        //     ->join('resultat_academiques', 'resultat_academiques.impetrant_id', '=', 'impetrants.id')
        //     ->join('attestation_provisoires', 'attestation_provisoires.resultatAcademique_id', '=', 'resultat_academiques.id')
        //     //->join('parcours', 'parcours.institution_id', '=', 'institutions_impetrants.id')    
        //     ->where('institutions_impetrants.institution_id', '=', $institution_id)
        //     ->where('institutions_impetrants.institution_id', '=', $institution_id)
        //     //->select('impetrants.*','resultat_academiques.*','attestation_provisoires.*')
        //     ->select('impetrants.*','moyenne','cote','session','dateSoutenance','parcours_id','anneeAcademique_id','annee_academiques.intitule')
        //     ->get(); 
        
         $impetrants = ResultatAcademique::with('annee_academique', 'impetrant', 'parcours')
         ->join('impetrants', 'resultat_academiques.impetrant_id', '=', 'impetrants.id')
         ->join('institutions_impetrants', 'institutions_impetrants.impetrant_id', '=', 'impetrants.id')
         
         ->where('institutions_impetrants.institution_id', '=', $institution_id)
         ->select('impetrants.*','anneeAcademique_id','parcours_id','moyenne','cote','session','dateSoutenance','reference')
         ->get();
      

        return $impetrants;
        
    }
}
