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
    
    
}