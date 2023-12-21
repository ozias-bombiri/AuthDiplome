<?php

namespace App\Http\Controllers\Metiers;

use App\Http\Controllers\Controller;
use App\Repositories\ActeAcademiqueRepository;
use App\Repositories\AnneeAcademiqueRepository;
use App\Repositories\AttestationDefinitiveRepository;
use App\Repositories\EtudiantRepository;
use App\Repositories\ImpetrantRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\NiveauEtudeRepository;
use App\Repositories\NumeroteurRepository;
use App\Repositories\ParcoursRepository;
use App\Repositories\ResultatAcademiqueRepository;
use App\Utils\DocumentCreator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;


class DiplomeController extends Controller
{
    protected $institutionRepository;
    protected $parcoursRepository;
    protected $niveauRepository;
    protected $anneeRepository;
    protected $attestationRepository;
    protected $resultatRepository;
    protected $impetrantRepository;
    protected $numeroteuRepository;
    protected $pdfCreator;

    public function __construct(InstitutionRepository $institutionRepo, 
                                ParcoursRepository $parcoursRepo, 
                                NiveauEtudeRepository $niveauRepo,
                                AnneeAcademiqueRepository $anneeRepo,
                                ActeAcademiqueRepository $attestationRepo,
                                ResultatAcademiqueRepository $resultatRepo,
                                EtudiantRepository $impetrantRepo,
                                NumeroteurRepository $numeroteurRepo,
                                DocumentCreator $pdfCreator)
    {
        $this->institutionRepository = $institutionRepo;
        $this->parcoursRepository = $parcoursRepo;
        $this->niveauRepository = $niveauRepo;
        $this->anneeRepository = $anneeRepo;
        $this->attestationRepository = $attestationRepo;
        $this->resultatRepository = $resultatRepo;
        $this->impetrantRepository = $impetrantRepo;
        $this->numeroteuRepository = $numeroteurRepo;
        $this->pdfCreator = $pdfCreator;
        
    }

    public function index()
    {
        if(isset($_GET['institution_id'])){
            $institution_id = $_GET['institution_id'];
        }else{
            $institution_id = 1;
        }
        if(isset($_GET['categorie_id'])){
            $categorie_id = $_GET['categorie_id'];
        }else{
            $categorie_id = 3;
        }
        $institution = Auth::user()->institution;
        $institution = $this->institutionRepository->find($institution->id);
        $annees = $this->anneeRepository->all();
        $niveaux = $this->niveauRepository->all();
        $parcours = $this->parcoursRepository->findByInstitution($institution->id);
        
        $attestations = $this->attestationRepository->findByEtablissement($institution->id, $categorie_id);
        // return view('metiers.etablissements.list_attestations', compact('attestations', 'institution', 'annees', 'niveaux', 'parcours'));

        return view("metiers.daoi.list_diplomes", compact('attestations', 'institution', 'annees', 'niveaux', 'parcours'));
    }


    /**
     * Lister les attestations defintives à partir du parcours de formation choisi
     **/
    public function listAttestation()
    {
        if(isset($_GET['institution_id'])){
            $institution_id = $_GET['institution_id'];
        }else{
            $institution_id = 1;
        }
        //$institution = Auth ::user()->institution;
        $institution = $this->institutionRepository->find($institution_id);
        $annees = $this->anneeRepository->all();
        $niveaux = $this->niveauRepository->all();
        $parcours = $this->parcoursRepository->findByIesr($institution->id);
        $attestations = $this->attestationRepository->findByIesr($institution->id);
        return view('metiers.daoi.list_attestations', compact('attestations', 'institution', 'annees', 'niveaux', 'parcours'));
    }

    public function filtreAttestation(Request $request)
    {
        $data = [];
        $inputs = $request->all();
        $niveau = $inputs['niveau'];
        $annee = $inputs['annee'];
        $parcours = $inputs['parcours']; 
        $institution = $this->institutionRepository->find($inputs['institution_id']);
        $annees = $this->anneeRepository->all();
        $niveaux = $this->niveauRepository->all();           
        $attestations = $this->attestationRepository->findByNiveauParcoursAnnee($niveau, $parcours, $annee); 

        if ($request->ajax()) {            
            if(empty($attestations)){
                $data = "Nothing";
            }
            else {
            $data = [
                'attestations' => $attestations,
            ];
            }
            return response()->json(['result' =>$data]);
        }
        
        return view('metiers.etablissements.list_attestations', compact('attestations', 'institution', 'annees', 'niveaux'));
    }

    /**
     * Ajouter une attestation provisoire à partir du parcours de formation choisi
     **/
    public function addAttestation(Request $request, $parcours, $impetrant)
    {
        $parcou = $this->parcoursRepository->find($parcours);
        $filiere = $parcou->filiere;
        $institution = $filiere->institution;
        //dd($institution);
        $signataires = $institution->signataires;
        
        $annees = $this->anneeRepository->all();
        $etudiant = $this->impetrantRepository->find($impetrant);
        /*
        if ($request->ajax()) {
            $data = [];
            if(empty($etudiant)){
                $data = "Nothing";
            }
            else {
            $data = [
                'annees' => $this->anneeRepository->all(),
                'parcours' => $institution->parcours,
                'signataires' => $institution->signataires,
                'etudiant' => $this->etudiantRepository->find($etudiant_id),
                'institution' => $institution
            ];
        }
            return response()->json(['result' =>$data]);
        } */
        
        return view('metiers.etablissements.add_attestation', compact('annees', 'parcou', 'signataires', 'etudiant', 'institution'));
    }

    /**
     * enregistrer les données du formulaire d'ajout d'une attestation provisoire à partir du parcours de formation choisi
     **/
    public function storeAttestation(Request $request)
    {
        $institution = Auth ::user()->institution;
        $inputs = $request->all();
        $numeroteur = $this->numeroteuRepository->findByInstitutionandCategorie($institution->id, 'provisoire');
        //Enregistrement du résultat académique
        $input_resultat = [];
        $input_resultat['reference'] = "RES".time();
        $input_resultat['soutenance'] = false;
        $input_resultat['dateSoutenance'] = null;
        //$input_resultat['dateSignature'] = $inputs['dateSignature'];
        $input_resultat['cote'] = $inputs['cote'];
        $input_resultat['moyenne'] = $inputs['moyenne'];
        $input_resultat['session'] = $inputs['sessionr'];
        $parcours = $this->parcoursRepository->find($inputs['parcours_id']);
        if($parcours->soutenance){
            $input_resultat['dateSoutenance'] = $inputs['dateSoutenance'];
        }
        else {
            $input_resultat['dateSoutenance'] = null;
        }
        $input_resultat['impetrant_id'] = $inputs['impetrant_id'];
        $input_resultat['parcours_id'] = $inputs['parcours_id'];
        $input_resultat['anneeAcademique_id'] = $inputs['annee_id'];
        $resultat = $this->resultatRepository->create($input_resultat);

        //Création de l'attestation
        $input_attestation = [];
        $input_attestation['reference'] = "AP".time(); 
        $input_attestation['intitule'] = "ATTESTATION PROVISOIRE DE ".strtoupper($parcours->niveau_etude->intitule);
        $input_attestation['dateSignature'] = $inputs['dateSignature'];
        $input_attestation['dateCreation'] = date('Y-m-d');
        $input_attestation['nombreGeneration'] = 0;
        $input_attestation['resultatAcademique_id'] = $resultat->id;
        $input_attestation['signataire_id'] = $inputs['signataire'];
        $input_attestation['lieuCreation'] = $inputs['lieuCreation'];
        $attestation = $this->attestationRepository->create($input_attestation);

        return redirect(route('metiers.etablissements.attestation-list', $institution->id ));
    }

    /**
     * Afficher le doucment pdf 
     **/
    
    public function pdfAttestation($id)
    {
        $attestation = $this->attestationRepository->find($id);
        $document_path = null;
        if($attestation->nombreGeneration >10){
            $document_path = config("custom.url_document").'/'.$attestation->reference.'.pdf';
        
        }
        else {
            $institution = $attestation->signataire->institution;
            $impetrant = $attestation->resultat_academique->impetrant;
            $parcours = $attestation->resultat_academique->parcours;
            $resultat = $attestation->resultat_academique ;
            $signataire = $attestation->signataire;
            $timbre = $signataire->timbre ;

            $document_path = $this->pdfCreator->createAttestationProvisoire($institution, $timbre, $parcours, $impetrant, $signataire, $attestation, $resultat);
        }

        return Response::make(file_get_contents(public_path($document_path)), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$attestation->reference.'"'
            ]);
    }

    /**
     * Afficher les informations détaillées d'une attestation provisoire
     **/
    public function viewAttestation(Request $request, $id)
    {
        $attestation = $this->attestationRepository->find($id);
        if ($request->ajax()) {
            $data = [];
            if(empty($attestation)){
                $data = "Nothing";
            }
            else {
            $data = [
                'reference' => $attestation->reference,
                'intitule' => $attestation->intitule,
                'impetrant' => $attestation->resultat_academique->impetrant->identifiant."\n ".$attestation->resultat_academique->impetrant->nom. " ".$attestation->resultat_academique->impetrant->prenom,
                'parcours' => $attestation->resultat_academique->parcours->intitule. " (".$attestation->resultat_academique->parcours->institution->sigle .")",
                'niveau' => $attestation->resultat_academique->parcours->niveau_etude->intitule,
                'institution' => $attestation->resultat_academique->parcours->institution->denomination,
                'sessionr' => "Année académique : ". $attestation->resultat_academique->annee_academique->intitule
                    ."\n Session : ".$attestation->resultat_academique->session. 
                    "\n Moyenne : ".$attestation->resultat_academique->moyenne.
                    "\n Côte :".$attestation->resultat_academique->cote,
                'id' => $attestation->id,
            ];
        }
            return response()->json(['result' =>$data]);
        }
        
        
        return view('metiers.etablissements.view_attestation', compact('attestation'));
    }

    public function filtreNiveau($id){
        $niveau = $this->niveauRepository->find($id);
        $attestations = $this->attestationRepository->findByNiveau($niveau->id);
        $institution = Auth::user()->institution ;
        $annees = $this->anneeRepository->all();
        $niveaux = $this->niveauRepository->all();
        $parcours = $this->parcoursRepository->findByInstitution($institution->id);
        return view('metiers.etablissements.list_attestations', compact('attestations', 'institution', 'annees', 'niveaux', 'parcours'));
    }

}
