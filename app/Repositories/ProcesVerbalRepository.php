<?php

namespace App\Repositories;

use App\Models\Inscription;
use App\Models\ProcesVerbal;
use App\Repositories\BaseRepository;

/**
 * Class ProcesVerbalRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class ProcesVerbalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'intitule',
		'soutenance',
		'domaine',
		'mention',
		'specialite',
		'description',
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
        return ProcesVerbal::class;
    }

    /**
     * Selectionner les pv d'un parcours
     **/
    public function findByParcours($parcours_id)
    {
        return ProcesVerbal::join('parcours', 'proces_verbaux.parcours_id', '=', 'parcours.id')
                ->where('parcours.id', $parcours_id)
                ->select('proces_verbaux.*')
                ->get();
    }

    /**
     * Selectionner les pv par année
     **/
    public function findByAnnee($annee)
    {
        return ProcesVerbal::join('annee_academiques', 'proces_verbaux.anneeAcademique_id', '=', 'annee_academiques.id')
                ->where('parcours.id', $annee)
                ->select('proces_verbaux.*')
                ->get();
    }

    /**
     * Selectionner les inscrits au parcours qui non pas encore de résultats
     **/
    public function findByNoResultats($procesVerbal_id)
    {
        $procesVerbal = ProcesVerbal::find($procesVerbal_id);
        $annee = $procesVerbal->anneeAcademique;
        $resultats = ProcesVerbal::join('resultat_academiques', 'resultat_academiques.procesVerbal_id', '=', 'proces_verbaux.id')
                ->where('proces_verbaux.id', $procesVerbal->id)
                ->select('resultat_academiques.inscription_id')
                ->get();

        $noResultats = Inscription::join('parcours', 'inscriptions.parcours_id', '=', 'parcours.id')
                ->join('proces_verbaux', 'proces_verbaux.parcours_id', '=', 'parcours.id')
                ->whereNotIn('inscriptions.id', $resultats)
                ->where('inscriptions.anneeAcademique_id', '=', $annee->id)                
                ->where('proces_verbaux.id', $procesVerbal->id)
                ->select('inscriptions.*')
                ->get();

        return $noResultats;

    }

    

    /**
     * Selectionner les pv d'un établissement
     **/
    public function findByEtablissement($institution_id)
    {
        return ProcesVerbal::join('parcours', 'proces_verbaux.parcours_id', '=', 'parcours.id')
                ->join('filieres', 'parcours.filiere_id', '=', 'filieres.id')
                ->join('institutions', 'filieres.institution_id', '=', 'institutions.id')
                ->where('institutions.id', $institution_id)
                ->select('proces_verbaux.*')
                ->get();
    }

    /**
     * Selectionner les pv d'une institution (iesr)
     **/
    public function findByIesr($iesr_id)
    {
        return ProcesVerbal::join('parcours', 'proces_verbaux.parcours_id', '=', 'parcours.id')
                ->join('filieres', 'parcours.filiere_id', '=', 'filieres.id')
                ->join('institutions', 'filieres.institution_id', '=', 'institutions.id')
                ->where('institutions.parent_id', $iesr_id)
                ->select('proces_verbaux.*')
                ->get();
    }

    

    /**
     * Selectionner par niveau
     **/
    public function findByNiveau($niveau)
    {
        return ProcesVerbal::join('parcours', 'proces_verbaux.parcours_id', '=', 'parcours.id')
                ->join('niveau_etudes', 'parcours.niveauEtude_id', '=', 'niveau_etudes.id')
                ->where('niveau_etudes.id', $niveau)
                ->select('proces_verbaux.*')
                ->get();
    }

    /**
     * Selectionner par filiere et niveau
     **/
    public function findByFiliereAndNiveau($filiere, $niveau)
    {
        return ProcesVerbal::join('parcours', 'proces_verbaux.parcours_id', '=', 'parcours.id')
                ->join('filieres', 'parcours.filiere_id', '=', 'filieres.id')
                ->join('niveau_etudes', 'parcours.niveauEtude_id', '=', 'niveau_etudes.id')
                ->where('filieres.id', $filiere)
                ->where('niveau_etudes.id', $niveau)
                ->select('proces_verbaux.*')
                ->get();
    }

    /**
     * Selectionner par etablissement et annee
     **/
    public function findByEtablissementAndAnnee($etablissement, $annee)
    {
        return ProcesVerbal::join('parcours', 'proces_verbaux.parcours_id', '=', 'parcours.id')
                ->join('filieres', 'parcours.filiere_id', '=', 'filieres.id')
                ->join('niveau_etudes', 'parcours.niveauEtude_id', '=', 'niveau_etudes.id')
                ->where('filieres.institution_id', $etablissement)
                ->where('proces_verbaux.anneeAcademique_id', $annee)
                ->select('proces_verbaux.*')
                ->get();
    }

    /**
     * Selectionner par iesr et annee
     **/
    public function findByIesrAndAnnee($iesr, $annee)
    {
        return ProcesVerbal::join('parcours', 'proces_verbaux.parcours_id', '=', 'parcours.id')
                ->join('filieres', 'parcours.filiere_id', '=', 'filieres.id')
                ->join('institutions', 'filieres.institution_id', '=', 'institutions.id')                
                ->join('niveau_etudes', 'parcours.niveauEtude_id', '=', 'niveau_etudes.id')
                ->where('institutions.parent_id', $iesr)
                ->where('proces_verbaux.anneeAcademique_id', $annee)
                ->select('proces_verbaux.*')
                ->get();
    }
}
