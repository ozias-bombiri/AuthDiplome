<?php

namespace App\Http\Controllers\Daoi;

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
        
        return view('metiers.daoi.list_parcours', compact('parcours', 'institution', 'niveaux', 'filieres'));
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

    /** 
    * Filtrer les parcours par niveau et etablissement
    **/
    public function filtreParcours(Request $request, $filiere, $niveau)
    {
        if($filiere ==0 && $niveau ==0){
            $parcours = $this->parcoursRepository->all();
        }
        else if($filiere ==0){
            $parcours =  $this->parcoursRepository->findByNiveau($niveau);

        }
        else if($niveau==0){
            $parcours =  $this->parcoursRepository->findByFiliere($filiere);

        }
        else {
            $parcours =  $this->parcoursRepository->findByFiliereAndNiveau($filiere, $niveau);

        }
        
        if ($request->ajax()) {            
            if(empty($parcours)){
                $data = "Nothing";
            }
            else {
            $data = [
                'attestations' => $parcours,
            ];
            }
            return response()->json(['result' =>$data]);
        }
        
        return view('metiers.daoi.list_parcours', compact('parcours', 'institution', 'niveaux', 'filieres'));
    }

}
