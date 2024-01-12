<?php

namespace App\Http\Controllers\Metiers;

use App\Http\Controllers\Controller;
use App\Repositories\AnneeAcademiqueRepository;
use App\Repositories\AttestationDefinitiveRepository;
use App\Repositories\EtudiantRepository;
use App\Repositories\ImpetrantRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\NiveauEtudeRepository;
use App\Repositories\NumeroteurRepository;
use App\Repositories\ParcoursRepository;
use App\Repositories\ResultatAcademiqueRepository;

use App\Repositories\SignataireRepository;
use App\Repositories\TimbreRepository;
use App\Models\ResultatAcademique;
use App\Models\Parcours;
use App\Repositories\ActeAcademiqueRepository;
use App\Repositories\CategorieActeRepository;
use App\Repositories\FiliereRepository;
use App\Utils\DocumentCreate;
use App\Utils\DocumentCreator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;



class AttestationDefinitiveController extends Controller
{
    protected $attestationRepository ;
    protected $filiereRepository ;
    protected $parcoursRepository;
    protected $niveauRepository;
    protected $signataireRepository;
    protected $institutionRepository ;
    protected $etudiantRepository;
    protected $anneeRepository;
    protected $resultatRepository ;
    protected $categorieActeRepository;
    protected $timbreRepository;
    protected $numeroteurRepository;
    protected $pdfCreator;



    public function __construct(
        
        FiliereRepository $filiereRepo,
        ParcoursRepository $parcoursRepo,
        ActeAcademiqueRepository $attestationRepo,
        NiveauEtudeRepository $niveauRepo,
        SignataireRepository $signataireRepo,
        InstitutionRepository $institutionRepo,
        EtudiantRepository $etudtiantRepo,
        AnneeAcademiqueRepository $anneeRepo,
        ResultatAcademiqueRepository $resultatRepo,
        CategorieActeRepository $categorieRepo,
        TimbreRepository $timbreRepo,
        NumeroteurRepository $numeroteurRepo,
        DocumentCreator $pdfCreator
         )
    {
        $this->attestationRepository = $attestationRepo;
        $this->filiereRepository = $filiereRepo ;
        $this->parcoursRepository = $parcoursRepo;
        $this->niveauRepository = $niveauRepo;
        $this->signataireRepository = $signataireRepo;
        $this->institutionRepository = $institutionRepo;
        $this->etudiantRepository = $etudtiantRepo;
        $this->anneeRepository = $anneeRepo;
        $this->resultatRepository = $resultatRepo;
        $this->categorieActeRepository = $categorieRepo;
        $this->timbreRepository = $timbreRepo;
        $this->numeroteurRepository = $numeroteurRepo;
        $this->pdfCreator = $pdfCreator;
    }
    public function index()
    {        
        $institution = Auth::user()->institution;
        //dd($institution);
        if(empty($institution->id)) {
            $institution = $this->institutionRepository->find(1);
        }        
        $parcours = null;
        $attestations = null;
        
        $categorieActeProvisoire = $this->categorieActeRepository->findByIntitule("DEFINITIVE");

        if($institution->type =="IESR") {
            $parcours = $this->parcoursRepository->findByIesr($institution->id);
            $attestations = $this->attestationRepository->findByIesrAndCategorieActe($institution->id, $categorieActeProvisoire->id );        
        }
        else {
            $parcours = $this->parcoursRepository->findByInstitution($institution->id);
            $attestations = $this->attestationRepository->findByEtablissementAndCategorieActe($institution->id, $categorieActeProvisoire->id );       
        
        }
        
        $annees = $this->anneeRepository->all();
        $niveaux = $this->niveauRepository->all();
        return view("metiers.actes.definitives.index", compact('attestations', 'institution', 'annees', 'niveaux', 'parcours'));
    }

    public function index2($niveau)

    {        
        $institution = Auth::user()->institution;
        //dd($institution);
        if(empty($institution->id)) {
            $institution = $this->institutionRepository->find(1);
        }        
        $parcours = null;
        $attestations = null;
        
        $categorieActeProvisoire = $this->categorieActeRepository->findByIntitule("DEFINITIVE");

        if($institution->type =="IESR") {
            $parcours = $this->parcoursRepository->findByIesr($institution->id);
            $attestations = $this->attestationRepository->findByIesrAndCategorieActeAndNiveau($institution->id, $categorieActeProvisoire->id, $niveau);        
        }
        else {
            $parcours = $this->parcoursRepository->findByInstitution($institution->id);
            $attestations = $this->attestationRepository->findByEtablissementAndCategorieActeAndNiveau($institution->id, $categorieActeProvisoire->id, $niveau);       
        
        }
        
        $annees = $this->anneeRepository->all();
        $niveaux = $this->niveauRepository->all();
        return view("metiers.actes.definitives.index", compact('attestations', 'institution', 'annees', 'niveaux', 'parcours'));
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
        if(isset($_GET['categorie_id'])){
            $categorie_id = $_GET['categorie_id'];
        }else{
            $categorie_id = 2;
        }
        //$institution = Auth ::user()->institution;
        $institution = $this->institutionRepository->find($institution_id);
        $annees = $this->anneeRepository->all();
        $niveaux = $this->niveauRepository->all();
        $parcours = $this->parcoursRepository->findByIesr($institution->id);
        $attestations = $this->attestationRepository->findByIesrAndCategorieActe($institution->id, $categorie_id);
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
        $etudiant = $this->etudiantRepository->find($impetrant);
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
        $numeroteur = $this->numeroteurRepository->findByInstitutionandCategorie($institution->id, 'provisoire');
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

     public function generer($acte_id){

        $attestation = $this->attestationRepository->find($acte_id);        
        $document_path = null;
        if(isset($attestation->documents) && count($attestation->documents) >10) {
            $document_path = config("custom.url_document").'/'.$attestation->reference.'.pdf';
        }
        else {
            $institution = $attestation->signataireActe->institution;
            $etudiant = $attestation->resultatAcademique->inscription->etudiant;
            $parcours = $attestation->resultatAcademique->procesVerbal->parcours;
            $resultat = $attestation->resultatAcademique ;
            $signataireActe = $attestation->signataireActe;
            
            $reponse = "Aucun timbre associé" ;
            if (count($institution->timbres) <1 ) return back()->with('reponse', $reponse); 
            $timbre = $institution->timbres[0] ;

            $document_path = $this->pdfCreator->createAttestationDefinitive($institution, $timbre, $parcours, $etudiant, $signataireActe, $attestation, $resultat);
        
        }
        
        return Response::make(file_get_contents(public_path($document_path)), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$attestation->reference.'"'
            ]);
    }
    
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