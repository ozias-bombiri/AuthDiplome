<?php

namespace App\Http\Controllers\Metiers;

use App\Http\Controllers\Controller;
use App\Models\AttestationProvisoire;
use App\Models\InstitutionImpetrant;
use App\Models\ResultatAcademique;
use App\Repositories\ActeAcademiqueRepository;
use App\Repositories\AnneeAcademiqueRepository;
use App\Repositories\EtudiantRepository;
use App\Repositories\FiliereRepository;
use App\Repositories\ImpetrantRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\NiveauEtudeRepository;
use App\Repositories\ParcoursRepository;
use App\Repositories\ResultatAcademiqueRepository;
use App\Repositories\SignataireRepository;
use App\Repositories\TimbreRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;
use File;
use App\Utils\DocumentCreator;
use Illuminate\Support\Facades\Auth;

class AttestationProvisoireController extends Controller
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
    protected $timbreRepository;
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
        TimbreRepository $timbreRepo,
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
        $this->timbreRepository = $timbreRepo;
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
            $categorie_id = 1;
        }
        //$institution = Auth::user()->institution;
        $institution = $this->institutionRepository->find($institution_id);
        $annees = $this->anneeRepository->all();
        $niveaux = $this->niveauRepository->all();
        $parcours = $this->parcoursRepository->findByInstitution($institution->id);
        $attestations = $this->attestationRepository->findByCategorieActe($categorie_id );
        // return view('metiers.etablissements.list_attestations', compact('attestations', 'institution', 'annees', 'niveaux', 'parcours'));

        return view("metiers.actes.provisoires.index", compact('attestations', 'institution', 'annees', 'niveaux', 'parcours'));
    }

    public function generer($acte_id){

        $attestation = $this->attestationRepository->find($acte_id);        
        $document_path = null;
        if(isset($attestation->documents) && count($attestation->documents) >0) {
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

            $document_path = $this->pdfCreator->createAttestationProvisoire($institution, $timbre, $parcours, $etudiant, $signataireActe, $attestation, $resultat);
        
        }
        
        return Response::make(file_get_contents(public_path($document_path)), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$attestation->reference.'"'
            ]);
    }

    


}