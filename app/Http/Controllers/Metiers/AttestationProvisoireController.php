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
use App\Repositories\TimbreRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;
use File;

use App\Utils\DocumentCreate;

class AttestationProvisoireController extends Controller
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
    protected $pdfCreator;

    public function __construct(
        AttestationProvisoireRepository $attestationRepo,
        ParcoursRepository $parcoursRepo,
        NiveauEtudeRepository $niveauRepo,
        SignataireRepository $signataireRepo,
        InstitutionRepository $institutionRepo,
        ImpetrantRepository $etudtiantRepo,
        AnneeAcademiqueRepository $anneeRepo,
        ResultatAcademiqueRepository $resultatRepo,
        TimbreRepository $timbreRepo,
        DocumentCreate $pdfCreator
         )
    {
        $this->attestationRepository = $attestationRepo;
        $this->parcoursRepository = $parcoursRepo;
        $this->niveauRepository = $niveauRepo;
        $this->signataireRepository = $signataireRepo;
        $this->institutionRepository = $institutionRepo;
        $this->etudiantRepository = $etudtiantRepo;
        $this->anneeRepository = $anneeRepo;
        $this->resultatRepository = $resultatRepo;
        $this->timbreRepository = $timbreRepo;
        $this->pdfCreator = $pdfCreator;
    }
    /** 
    * Afficher les parcours de son etablissement
    **/
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
        return view('metiers.etablissements.list_attestations', compact('attestations', 'institution', 'annees', 'niveaux'));
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
        $signataires = $institution->signataires;
        $annees = $this->anneeRepository->all();
        $parcours = $institution->parcours;
        $etudiant = $this->etudiantRepository->find($etudiant_id);

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
        }
        
        return view('metiers.etablissements.add_attestation', compact('annees', 'parcours', 'signataires', 'etudiant', 'institution'));
    }

    /**
     * enregistrer les données du formulaire d'ajout d'une attestation provisoire à partir du parcours de formation choisi
     **/
    public function storeAttestation(Request $request)
    {
        $institution = Auth ::user()->institution;
        $inputs = $request->all();

        //Enregistrement du résultat académique
        $input_resultat = [];
        $input_resultat['reference'] = "RES".time();
        $input_resultat['soutenance'] = false;
        $input_resultat['dateSignature'] = date('Y-m-d');
        $input_resultat['dateSignature'] = $inputs['dateSignature'];
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
        $input_resultat['impetrant_id'] = $inputs['impetrant'];
        $input_resultat['parcours_id'] = $inputs['parcours_id'];
        $input_resultat['anneeAcademique_id'] = $inputs['annee_id'];
        $resultat = $this->resultatRepository->create($input_resultat);

        //Création de l'attestation
        $input_attestation = [];
        $input_attestation['reference'] = "AP".time(); 
        $input_attestation['intitule'] = "ATTESTATION PROVISOIRE DE ".strtoupper($parcours->niveau_etude->intitule);
        $input_attestation['dateSignature'] = $inputs['dateSignature'];
        $input_attestation['dateCreation'] = date('Y-m-d');
        $input_attestation['statutGeneration'] = false;
        $input_attestation['resultatAcademique_id'] = $resultat->id;
        $input_attestation['signataire_id'] = $inputs['signataire'];
        $input_attestation['lieuCreation'] = $inputs['lieuCreation'];
        $attestation = $this->attestationRepository->create($input_attestation);

        return redirect(route('metiers.etablissements.attestation-list', $institution->id ));
    }

    /**
     * Afficher les informations détaillées d'une attestation provisoire
     **/
    public function pdfAttestation1($id)
    {
        $attestation = $this->attestationRepository->find($id);
        
        $institution = $attestation->signataire->institution;
        $timbre = $institution->timbre ;
        $impetrant = $attestation->resultat_academique->impetrant;
        $parcours = $attestation->resultat_academique->parcours;
        $resultat = $attestation->resultat_academique ;
        $signataire = $attestation->signataire;
        $path = 'img/logo_unz.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);
        

        $path = 'img/qrcode/' ;


        if(!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path));
        }

        $file_path = $path . $attestation->reference. '.png';
        $lien = "http://192.168.135.81:8081/authentification/view/provisoire/".$id;
        
        $qr_infos = $attestation->intitule."\nRef :".$attestation->reference."\n \n ".$lien ;
        QrCode::generate($qr_infos, public_path($file_path) );
        $type = pathinfo($file_path, PATHINFO_EXTENSION);
        $image = file_get_contents($file_path);

        $qrcode = 'data:image/' . $type . ';base64,' . base64_encode($image);
       
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                    ->loadView('maquettes.licences.provisoire1', compact('institution', 'timbre', 'parcours', 'impetrant', 'signataire', 'attestation', 'resultat', 'logo', 'qrcode'));
        
        // set the PDF rendering options
        //$customPaper = array(0,0,600.00,310.80);
        $pdf->setPaper('A4', 'portrait');
        $pdf->output();

        $canvas = $pdf->getDomPDF()->getCanvas();
        $height = $canvas->get_height();
        $width = $canvas->get_width();
        $canvas->set_opacity(.2,"Multiply");
        $canvas->set_opacity(.2);
        $canvas->page_text($width/5, $height/2, 'ATTESTATION PROVISOIRE', null, 30, array(0,0,0),2,2,-30);
        //$filename = config("custom.document_url").'/'.$attestation->reference.'.pdf';
        //file_put_contents('filename.pdf', $filename);
        return $pdf->stream(); 
        
        
        //return view('maquettes.licences.provisoire1', compact('institution', 'timbre', 'parcours', 'impetrant', 'signataire', 'attestation', 'resultat', 'logo', 'qrcode'));
    }

    public function pdfAttestation($id)
    {
        $attestation = $this->attestationRepository->find($id);
        $document_path = null;
        if($attestation->nombreGeneration >0){
            $document_path = config("custom.url_document").'/'.$attestation->reference.'.pdf';
        
        }
        else {
            $institution = $attestation->signataire->institution;
            $timbre = $institution->timbre ;
            $impetrant = $attestation->resultat_academique->impetrant;
            $parcours = $attestation->resultat_academique->parcours;
            $resultat = $attestation->resultat_academique ;
            $signataire = $attestation->signataire;
            

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

    /**
     * Lister les étudiants inscrits  dans l'établissement
     **/
    public function listEtudiants($institution_id)
    {
        $institution = $this->institutionRepository->find($institution_id);
        
        $etudiants = $this->etudiantRepository->findByInstitution($institution->id);
        //$etudiants = $this->etudiantRepository->all();
        
        //dd($etudiants);
        return view('metiers.etablissements.list_etudiants', compact('etudiants', 'institution'));
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
        $institution = $this->institutionRepository->find($input['institution_id']);
        $input['nom'] = strtoupper($input['nom']);
        $etudiant = $this->etudiantRepository->create($input);

        $inscription = new InstitutionImpetrant();
        $inscription->institution_id = $institution->id;
        $inscription->impetrant_id = $etudiant->id;
        $inscription->referenceInscription = $input['reference'];
        $inscription->annee = $input['annee'];
        $inscription->save();

        return redirect(route('metiers.etablissements.etudiant-list', $institution->id));
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
        $input['nom'] = strtoupper($input['nom']);
        $input['institution_id'] = $institution->id ;
        $input['typeDocument'] = "Attestation Provisoire" ;
        $signataire = $this->signataireRepository->create($input);
        return redirect(route('metiers.etablissements.signataire-list', $institution->id));
    }

}