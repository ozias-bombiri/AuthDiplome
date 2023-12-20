<?php

namespace App\Http\Controllers\Etablissement;

use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use App\Models\Inscription;
use App\Repositories\EtudiantRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\ParcoursRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EtudiantController extends Controller
{
    protected $institutionRepository;
    protected $impetrantRepository;
    protected $inscriptionRepository;
    protected $parcoursRepository;

    public function __construct(InstitutionRepository $institutionRepo, EtudiantRepository $impetrantRepo, ParcoursRepository $parcoursRepo)
    {
        $this->institutionRepository = $institutionRepo;
        $this->impetrantRepository = $impetrantRepo;
        $this->parcoursRepository = $parcoursRepo;
    }


    /**
     * Lister les étudiants inscrits  dans l'établissement
     **/
    public function listEtudiants($institution_id)
    {
        $institution = $this->institutionRepository->find($institution_id);
        
        $etudiants = $this->impetrantRepository->findByEtablissement($institution->id);
        //dd($etudiants);
        return view('metiers.etablissements.list_etudiants', compact('etudiants', 'institution'));
    }

    /**
     * Ajouter un étudiant
     **/
    public function addEtudiant($id)
    {
        $institution = Auth ::user()->institution;
        $parcours = $this->parcoursRepository->find($id);
        return view('metiers.etablissements.add_etudiant', compact('institution', 'parcours'));
    }

    /**
     * enregistrer les données du formulaire d'ajout d'étudiant
     **/
    public function storeEtudiant(Request $request)
    {
        $institution = Auth ::user()->institution;
        $input = $request->all();
        $parcours = $this->parcoursRepository->find($input['parcours_id']);
        $input['nom'] = strtoupper($input['nom']);
        $input['nevers'] = (isset($input['nevers'])) ? true : false ;
        $etudiant = $this->impetrantRepository->findByIdentifiant($input['identifiant']);
        if(empty($etudiant)){
            $etudiant = $this->impetrantRepository->create($input);
        }
        $inscription = new Inscription();
        $inscription->parcours_id = $parcours->id;
        $inscription->impetrant_id = $etudiant->id;
        $inscription->referenceInscription = $input['reference'];
        $inscription->annee = $input['annee'];
        $inscription->save();

        return redirect(route('metiers.etablissements.parcours-view', $parcours->id));
    }

}
