<?php

namespace App\Http\Controllers\Etablissement;

use App\Http\Controllers\Controller;
use App\Repositories\InstitutionRepository;
use App\Repositories\NiveauEtudeRepository;
use App\Repositories\ParcoursRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParcoursController extends Controller
{
    protected $institutionRepository;
    protected $parcoursRepository;
    protected $niveauRepository;
   
    public function __construct(InstitutionRepository $institutionRepo, ParcoursRepository $parcoursRepo, NiveauEtudeRepository $niveauRepo)
    {
        $this->institutionRepository = $institutionRepo;
        $this->parcoursRepository = $parcoursRepo;
        $this->niveauRepository = $niveauRepo;
    }
    
    /** 
    * Afficher les parcours de son etablissement
    **/
    public function listParcours($institution_id)
    {
        $institution = $this->institutionRepository->find($institution_id);
        $niveaux = $this->niveauRepository->all();
        $filieres = $institution->filieres;

        $parcours =  $this->parcoursRepository->findByInstitution($institution->id);
        
        return view('metiers.etablissements.list_parcours', compact('parcours', 'institution', 'niveaux', 'filieres'));
    }

    /** 
    * Ajouter un parcours de son etablissement
    **/
    public function addParcours()
    {
        $institution = Auth::user()->institution;
        $niveaux = $this->niveauRepository->all();
        return view('metiers.etablissements.add_parcours', compact('niveaux', 'institution'));
    }

    /** 
    * Enregistrer les données saisi dans le formulaire
    **/
    public function storeParcours(Request $request)
    {
        $input = $request->all(); 
        $input['soutenance'] = (isset($input['soutenance'])) ? true : false ;
        $institution = Auth::user()->institution;
        $parcours = $this->parcoursRepository->create($input);
        return redirect(route('metiers.etablissements.parcours-list', $institution->id));
    }

    /** 
    * Voir  un parcours de son etablissement
    **/
    public function viewParcours($id)
    {
        $parcours = $this->parcoursRepository->find($id);
        $etudiants = $parcours->impetrants ;
        return view('metiers.etablissements.view_parcours', compact('parcours', 'etudiants'));
    }

}
