<?php

namespace App\Http\Controllers\Metiers;

use App\Http\Controllers\Controller;
use App\Repositories\AttestationProvisoireRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\NiveauEtudeRepository;
use App\Repositories\ParcoursRepository;
use App\Repositories\SignataireRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\ImpetrantRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;


class AttestationProvisoireController extends Controller
{
    private $modelParcoursRepository;
    private $modelEtudiantRepository;
    protected $attestationRepository ;
    protected $parcoursRepository;
    protected $niveauRepository;
    protected $signataireRepository;
    protected $institutionRepository;
    protected $impetrantRepository;

    public function __construct(
        AttestationProvisoireRepository $attestationRepo,
        ParcoursRepository $parcoursRepo,
        NiveauEtudeRepository $niveauRepo,
        SignataireRepository $signataireRepo,
        InstitutionRepository $institutionRepo,
        ImpetrantRepository $impetrantRepo,
        
         )
    {
        $this->modelParcoursRepository = $parcoursRepo;
        $this->modelEtudiantRepository = $impetrantRepo;
        $this->attestationRepository = $attestationRepo;
        $this->parcoursRepository = $parcoursRepo;
        $this->niveauRepository = $niveauRepo;
        $this->signataireRepository = $signataireRepo;
        $this->institutionRepository = $institutionRepo;
    }
    /** 
    * Afficher les parcours de son etablissement
    **/
    public function listParcours(Request $request)
    {

        if ($request->ajax()) {
            
            $institution = Auth ::user()->institution;
            $data = null;
            if($institution && $institution->type !='IESR'){
                $data = $institution->parcours;
            }
            else {
                $data = $this->parcoursRepository->all();
                // $data = $this->parcoursRepository->with('niveau_etude', 'institution')
                // ->select('intitule','credit','domaine','mention','specialite','description','sigle', 'intitule')
                // ->get();
            }
           
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="#" class="edit btn btn-success btn-sm">Edit</a> 
                                  <a href="#" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('metiers.etablissements.list_parcours'/*, compact('parcours')*/);
    }

    /** 
    * Ajouter un parcours de son etablissement
    **/
    public function addParcours()
    {
        $niveaux = $this->niveauRepository->all();
        $institutions = $this->institutionRepository->all();
        return view('metiers.etablissements.add_parcours', compact('niveaux', 'institutions'));
    }

    /** 
    * Enregistrer les données saisi dans le formulaire
    **/
    public function storeParcours(Request $request)
    {
        $input = $request->all();

        $parcours = $this->modelRepository->create($input);

        return redirect(route('metiers.etablissements.parcours-list'));
        
    } 

    /**
     * Lister les attestations provisoires à partir du parcours de formation choisi
     **/
    public function listAttestation()
    {
        return view('metiers.etablissements.list_attestations');
    }

    /**
     * Ajouter une attestation provisoire à partir du parcours de formation choisi
     **/
    public function addAttestation($parcours_id)
    {
        return view('metiers.etablissements.add_attestation');
    }

    /**
     * enregistrer les données du formulaire d'ajout d'une attestation provisoire à partir du parcours de formation choisi
     **/
    public function storeAttestation($parcours_id)
    {
        return redirect(route('metiers.etablissements.attestation-list'));
    }


    /**
     * Lister les étudiants inscrits  dans l'établissement
     **/
    public function listEtudiants(Request $request)
    {
        if ($request->ajax()) {

            $data = $this->modelEtudiantRepository->all();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="#" class="edit btn btn-success btn-sm">Edit</a> 
                                  <a href="#" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        
        return view('metiers.etablissements.list_etudiants');
    }

    /**
     * Ajouter un étudiant
     **/
    public function addEtudiant()
    {
        return view('metiers.etablissements.add_etudiant');
    }

    /**
     * enregistrer les données du formulaire d'ajout d'étudiant
     **/
    public function storeEtudiant(Request $request)
    {
        $input = $request->all();

        $etudiants = $this->modelEtudiantRepository->create($input);

        return redirect(route('metiers.etablissements.etudiant-list'));
    }



    /**
     * Lister les signaitaires de l'établissement
     **/
    public function listSignataires($institution_id)
    {
        //$institution = Auth ::user()->institution;
        $institution = $this->institutionRepository->find($institution_id);
        $signataires = null;
        if($institution && $institution->type !='IESR'){
            $signataires = $institution->signataires;
        }
        else {
            $signataires = $this->signataireRepository->all();
        }
        return view('metiers.etablissements.list_signataires', compact('signataires'));
    }

    /**
     * Ajouter un signataire
     **/
    public function addSignataire()
    {
        return view('metiers.etablissements.add_signataire');
    }

    /**
     * enregistrer les données du formulaire d'ajout de signataire
     **/
    public function storeSignataire(Request $request)
    {
        $institution = Auth ::user()->institution;
        $input = $request->all();
        $input['institution_id'] = $institution->id ;
        $input['typeDocument'] = "Attestation Provisoire" ;
        $signataire = $this->signataireRepository->create($input);
        return redirect(route('metiers.etablissements.signataire-list', $institution->id));
    }

}
