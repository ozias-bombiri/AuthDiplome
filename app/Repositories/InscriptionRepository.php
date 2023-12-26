<?php

namespace App\Repositories;

use App\Models\Inscription;
use App\Repositories\BaseRepository;

/**
 * Class InscriptionRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class InscriptionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'referenceInscription',
		'annee',
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
        return Inscription::class;
    }

    public function findByReference($reference){
        $attestation = Inscription::where('referenceInscription', '=', $reference)
                        ->first();
        return $attestation;        
    }

    public function findByParcours($parcours_id){
        $insctiptions = Inscription::where('parcours_id', '=', $parcours_id)
                        ->get();
        return $insctiptions;        
    }
    /**
     * Selectionner par filiere et niveau
     **/
    public function findByParcoursandAnnee($parcours_id, $annee_id)
    {
        return Inscription::where('parcours_id', '=', $parcours_id)
                ->where('anneeAcademique_id', '=', $annee_id)
                ->get();
    }
}
