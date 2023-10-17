<?php

namespace App\Http\Controllers\Metiers;

use App\Http\Controllers\Controller;
use App\Models\AttestationProvisoire;
use App\Models\InstitutionImpetrant;
use App\Models\ResultatAcademique;
use App\Repositories\AnneeAcademiqueRepository;
use App\Repositories\AttestationProvisoireRepository;
use App\Repositories\ImpetrantRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\NiveauEtudeRepository;
use App\Repositories\ParcoursRepository;
use App\Repositories\ResultatAcademiqueRepository;
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
<<<<<<< HEAD
    protected $institutionRepository;
    protected $impetrantRepository;
=======
    protected $institutionRepository ;
    protected $etudiantRepository;
    protected $anneeRepository;
    protected $resultatRepository ;
>>>>>>> b439b7e (Ajout d'atttestation provisoire ok. Liste de parcours admin.)

    public function __construct(
        AttestationProvisoireRepository $attestationRepo,
        ParcoursRepository $parcoursRepo,
        NiveauEtudeRepository $niveauRepo,
        SignataireRepository $signataireRepo,
        InstitutionRepository $institutionRepo,
<<<<<<< HEAD
        ImpetrantRepository $impetrantRepo,
        
=======
        ImpetrantRepository $etudtiantRepo,
        AnneeAcademiqueRepository $anneeRepo,
        ResultatAcademiqueRepository $resultatRepo
>>>>>>> b439b7e (Ajout d'atttestation provisoire ok. Liste de parcours admin.)
         )
    {
        $this->modelParcoursRepository = $parcoursRepo;
        $this->modelEtudiantRepository = $impetrantRepo;
        $this->attestationRepository = $attestationRepo;
        $this->parcoursRepository = $parcoursRepo;
        $this->niveauRepository = $niveauRepo;
        $this->signataireRepository = $signataireRepo;
        $this->institutionRepository = $institutionRepo;
        $this->etudiantRepository = $etudtiantRepo;
        $this->anneeRepository = $anneeRepo;
        $this->resultatRepository = $resultatRepo;
    }
    /** 
    * Afficher les parcours de son etablissement
    **/
<<<<<<< HEAD
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
=======
    public function listParcours($institution_id)
    {
        $institution = $this->institutionRepository->find($institution_id);
        $parcours = null;
        if($institution && $institution->type !='IESR'){
            $parcours = $institution->parcours;
>>>>>>> b439b7e (Ajout d'atttestation provisoire ok. Liste de parcours admin.)
        }
        return view('metiers.etablissements.list_parcours'/*, compact('parcours')*/);
    }

    /** 
    * Ajouter un parcours de son etablissement
    **/
    public function addParcours()
    {
        $institution = Auth::user()->institution;
        $niveaux = $this->niveauRepository->all();
<<<<<<< HEAD
        $institutions = $this->institutionRepository->all();
        return view('metiers.etablissements.add_parcours', compact('niveaux', 'institutions'));
=======
        return view('metiers.etablissements.add_parcours', compact('niveaux', 'institution'));
>>>>>>> b439b7e (Ajout d'atttestation provisoire ok. Liste de parcours admin.)
    }

    /** 
    * Enregistrer les données saisi dans le formulaire
    **/
    public function storeParcours(Request $request)
    {
        $input = $request->all();
<<<<<<< HEAD

        $parcours = $this->modelRepository->create($input);

        return redirect(route('metiers.etablissements.parcours-list'));
        
    } 
=======
        $parcours = $this->parcoursRepository->create($input);
        return redirect(route('metiers.etablissements.parcours-list'));
    }
>>>>>>> b439b7e (Ajout d'atttestation provisoire ok. Liste de parcours admin.)

    /**
     * Lister les attestations provisoires à partir du parcours de formation choisi
     **/
    public function listAttestation($institution_id)
    {
        //$institution = Auth ::user()->institution;
        $institution = $this->institutionRepository->find($institution_id);
        $attestations = null;
        if($institution && $institution->type !='IESR'){
            $attestations = $this->attestationRepository->findByInstitution($institution_id);
        }
        else {
            $attestations = $this->attestationRepository->all();
        }
        return view('metiers.etablissements.list_attestations', compact('attestations'));
    }

    /**
     * Ajouter une attestation provisoire à partir du parcours de formation choisi
     **/
    public function addAttestation($etudiant_id)
    {
        $signataires = $this->signataireRepository->all();
        $annees = $this->anneeRepository->all();
        $parcours = $this->parcoursRepository->all();
        $etudiant = $this->etudiantRepository->find($etudiant_id);
        return view('metiers.etablissements.add_attestation', compact('annees', 'parcours', 'signataires', 'etudiant'));
    }

    /**
     * enregistrer les données du formulaire d'ajout d'une attestation provisoire à partir du parcours de formation choisi
     **/
    public function storeAttestation(Request $request)
    {
        $institution = Auth ::user()->institution;
        $inputs = $request->all();
        $input_resultat = [];
        $input_resultat['reference'] = "RES".time();
        $input_resultat['soutenance'] = false;
        $input_resultat['dateSignature'] = date('Y-m-d');
        $input_resultat['cote'] = $inputs['cote'];
        $input_resultat['moyenne'] = $inputs['moyenne'];
        $input_resultat['session'] = $inputs['sessionr'];
        $input_resultat['dateSoutenance'] = $inputs['dateSoutenance'];
        $input_resultat['impetrant_id'] = $inputs['impetrant'];
        $input_resultat['parcours_id'] = $inputs['parcours_id'];
        $input_resultat['anneeAcademique_id'] = $inputs['annee_id'];
        $resultat = $this->resultatRepository->create($input_resultat);

        $input_attestation = [];
        $input_attestation['reference'] = "AP".time(); 
        $input_attestation['intitule'] = "Attestation Provisoire";
        $input_attestation['dateSignature'] = date('Y-m-d');
        $input_attestation['dateCreation'] = date('Y-m-d');
        $input_attestation['statutGeneration'] = false;
        $input_attestation['resultatAcademique_id'] = $resultat->id;
        $input_attestation['signataire_id'] = $inputs['signataire'];
        $attestation = $this->attestationRepository->create($input_attestation);

        return redirect(route('metiers.etablissements.attestation-list', $institution->id ));
    }
    

    /**
     * Lister les étudiants inscrits  dans l'établissement
     **/
<<<<<<< HEAD
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
=======
    public function listEtudiants($institution_id)
    {
        $institution = $this->institutionRepository->find($institution_id);
        
        $etudiants = $this->etudiantRepository->findByInstitution($institution->id);
        //$etudiants = $this->etudiantRepository->all();
        return view('metiers.etablissements.list_etudiants', compact('etudiants'));
>>>>>>> b439b7e (Ajout d'atttestation provisoire ok. Liste de parcours admin.)
    }

    /**
     * Ajouter un étudiant
     **/
    public function addEtudiant()
    {
        $institution = Auth ::user()->institution;
        return view('metiers.etablissements.add_etudiant', compact('institution'));
    }

    /**
     * enregistrer les données du formulaire d'ajout d'étudiant
     **/
    public function storeEtudiant(Request $request)
    {
        $input = $request->all();
<<<<<<< HEAD

        $etudiants = $this->modelEtudiantRepository->create($input);

        return redirect(route('metiers.etablissements.etudiant-list'));
=======
        $institution = $this->institutionRepository->find($input['institution_id']);
        
        $etudiant = $this->etudiantRepository->create($input);

        $inscription = new InstitutionImpetrant();
        $inscription->institution_id = $institution->id;
        $inscription->impetrant_id = $etudiant->id;
        $inscription->referenceInscription = $input['reference'];
        $inscription->annee = $input['annee'];
        $inscription->save();

        return redirect(route('metiers.etablissements.etudiant-list', $institution->id));
>>>>>>> b439b7e (Ajout d'atttestation provisoire ok. Liste de parcours admin.)
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
