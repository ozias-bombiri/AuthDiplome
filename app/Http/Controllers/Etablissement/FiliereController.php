<?php

namespace App\Http\Controllers\Etablissement;

use App\Http\Controllers\Controller;
use App\Repositories\FiliereRepository;
use App\Repositories\InstitutionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FiliereController extends Controller
{
    protected $institutionRepository;
    protected $filiereRepository ;
    
    public function __construct(InstitutionRepository $institutionRepo, FiliereRepository $filiereRepo)  {
        $this->institutionRepository = $institutionRepo;
        $this->filiereRepository = $filiereRepo;
    }
    /** 
    * Afficher les filieres de son etablissement
    **/
    public function listFiliere($institution_id)
    {
        $institution = $this->institutionRepository->find($institution_id);
        $filieres = $institution->filieres;
        return view('metiers.etablissements.list_filieres', compact('filieres', 'institution'));
    }

    /** 
    * Ajouter une filiere de son etablissement
    **/
    public function addFiliere()
    {
        $institution = Auth::user()->institution;
        return view('metiers.etablissements.add_filiere', compact('institution'));
    }

    /** 
    * Enregistrer les données saisi dans le formulaire
    **/
    public function storeFiliere(Request $request)
    {
        $input = $request->all(); 
        $institution = Auth::user()->institution;
        $filiere = $this->filiereRepository->create($input);
        return redirect(route('metiers.etablissements.filiere-list', $institution->id));
    }

}
