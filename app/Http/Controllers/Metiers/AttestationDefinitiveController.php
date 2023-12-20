<?php

namespace App\Http\Controllers\Metiers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Repositories\ImpetrantRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\NiveauEtudeRepository;
use App\Repositories\ParcoursRepository;
use App\Repositories\AttestationDefinitiveRepository;
use App\Repositories\ResultatAcademiqueRepository;
use App\Repositories\SignataireRepository;
use App\Repositories\TimbreRepository;
use App\Repositories\AnneeAcademiqueRepository;
use App\Models\ResultatAcademique;
use App\Models\Parcours;
use Illuminate\Support\Facades\Auth;
use App\Utils\DocumentCreate;


class AttestationDefinitiveController extends Controller
{

    protected $attestationRepository ;
    protected $parcoursRepository;
    protected $niveauRepository;
    protected $signataireRepository;
    protected $institutionRepository ;
    protected $etudiantRepository;
    protected $anneeRepository;
    protected $resultatRepository ;
    protected $timbreRepository;
    protected $pdfCreator ;

    public function __construct(
           // AttestationDefinitiveRepository $attestationRepo,
            ParcoursRepository $parcoursRepo,
            NiveauEtudeRepository $niveauRepo,
            SignataireRepository $signataireRepo,
            InstitutionRepository $institutionRepo,
            //ImpetrantRepository $etudtiantRepo,
            AnneeAcademiqueRepository $anneeRepo,
            ResultatAcademiqueRepository $resultatRepo,
            TimbreRepository $timbreRepo,
            //DocumentCreate $pdfCreator
         )
    {
        //$this->attestationRepository = $attestationRepo;
        $this->parcoursRepository = $parcoursRepo;
        $this->niveauRepository = $niveauRepo;
        $this->signataireRepository = $signataireRepo;
        $this->institutionRepository = $institutionRepo;
        //$this->etudiantRepository = $etudtiantRepo;
        $this->anneeRepository = $anneeRepo;
        $this->resultatRepository = $resultatRepo;
        $this->timbreRepository = $timbreRepo;
        //$this->pdfCreator = $pdfCreator;
    }
    


    /**
     * Liste des parcours
     */
    public function listParcours($institution_id)
    {
        $institution = $this->institutionRepository->find($institution_id);
        $niveaux = $this->niveauRepository->all();
        $parcours = null;
        if($institution && $institution->type !='IESR'){
            $parcours = $institution->parcours;
        }
        else {
            $parcours = $this->parcoursRepository->all();
        }
        return view('metiers.etablissements.list_parcours', compact('parcours', 'institution', 'niveaux'));
    }

    /**
     * Liste des étudiants
     */

    public function listEtudiantsAttDef($institution_id)
    {
        $institution = $this->institutionRepository->find($institution_id);
        
        $etudiants = $this->etudiantRepository->findByInstitution($institution->id);

        
        
        //$etudiants = $this->resultatRepository->findByInstitution($institution->id);

        //$etudiants = $this->etudiantRepository->all();

        // $resultAcaEtudiants = Impetrant::join('resultat_academiques', 'resultat_academiques.impetrant_id', '=', 'impetrants.id')
        
        //$signataires = $this->signataireRepository->signataireAttesDef();
        
        

        //dd($signataireTypeDoc);

        return view('metiers.daoi.list_etudiants_att_def', compact('etudiants', 'institution'));


    }


     /**
     * Lister les attestations provisoires à partir du parcours de formation choisi
     **/
    public function listAttestation($institution_id)
    {
        //$institution = Auth ::user()->institution;
        $institution = $this->institutionRepository->find($institution_id);
        $annees = $this->anneeRepository->all();
        $niveaux = $this->niveauRepository->all();
        $attestations = null;
        if($institution && $institution->type !='IESR'){
            $attestations = $this->attestationRepository->findByInstitution($institution_id);
        }
        else {
            $attestations = $this->attestationRepository->all();
        }
        return view('metiers.daoi.list_attestationsdef', compact('attestations', 'institution', 'annees', 'niveaux'));
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
    public function addAttestation(Request $request, $institution_id, $etudiant_id)
    {
        $institution = $this->institutionRepository->find($institution_id);
        //$signataires = $institution->signataires;
        $signataires = $this->signataireRepository->signataireAttesDef($institution->id, "Attestation Definitive");
        $annees = $this->anneeRepository->all();
        $parcours = $institution->parcours;
        //$etudiant = $this->etudiantRepository->find($etudiant_id);
        $etudiant = $this->resultatRepository->findByInstitution($institution->id)
        ->find($etudiant_id);
        
        $resultats = $this->resultatRepository->find($etudiant_id);

        //dd($resultats);
        
        if ($request->ajax()) {
            $data = [];
            if(empty($etudiant)){
                $data = "Nothing";
            }
            else {
            $data = [
                'annees' => $this->anneeRepository->all(),
                'parcours' => $institution->parcours,
                'signataires'  => $signataires,
                'etudiant' => $etudiant,
                'institution' => $institution,
            ];
        }
            return response()->json(['result' =>$data]);
        }
        
        return view('metiers.daoi.add_attestation', compact('annees', 'parcours', 'signataires', 'etudiant', 'institution'));
    }

    /**
     * enregistrer les données du formulaire d'ajout d'une attestation provisoire à partir du parcours de formation choisi
     **/
    public function storeAttestation(Request $request)
    {
        $institution = Auth ::user()->institution;
        $inputs = $request->all();
        $input_resultat = [];

        //Recuperation du niveau d'etude
        $parcours_intitule = $request->input('parcours_id');
        $id_parcours = Parcours::where('intitule', $parcours_intitule)->value('id');
        $id_niveau_etude = Parcours::with('niveau_etude')
        ->select('niveauEtude_id')
        ->where('parcours.intitule','=', $parcours_intitule)
        ->first();
        $intitule_niveau = $id_niveau_etude->niveau_etude->intitule;
        //Recuperation id de resultat academique
        $reference_resultat = $request->input('reference');
        $id_resultat = ResultatAcademique::where('reference', $reference_resultat)->value('id');
       
        //Création de l'attestation definitive
        $input_attestation = [];
        $input_attestation['reference'] = "AD".time(); 
        $input_attestation['intitule'] = "ATTESTATION PROVISOIRE DE ".strtoupper($intitule_niveau);
        $input_attestation['dateSignature'] = $inputs['dateSignature'];
        $input_attestation['dateCreation'] = date('Y-m-d');
        $input_attestation['statutGeneration'] = false;
        $input_attestation['resultatAcademique_id'] = $id_resultat;
        $input_attestation['signataire_id'] = $inputs['signataire'];
        $input_attestation['lieuCreation'] = $inputs['lieuCreation'];
        
        $attestation = $this->attestationRepository->create($input_attestation);

        
        return redirect(route('metiers.daoi.attestationdef-list', $institution->id ));
    }

    /**
     * Afficher les informations détaillées d'une attestation provisoire
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
        $timbre = $institution->timbre ;
        $impetrant = $attestation->resultat_academique->impetrant;
        $parcours = $attestation->resultat_academique->parcours;
        $resultat = $attestation->resultat_academique ;
        $signataire = $attestation->signataire;

        $document_path = $this->pdfCreator->createAttestationDefinitive($institution, $timbre, $parcours, $impetrant, $signataire, $attestation, $resultat);
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
   
   
}


