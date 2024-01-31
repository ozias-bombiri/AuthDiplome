<?php

namespace App\Http\Controllers\Metiers;

use App\Http\Controllers\Controller;
use App\Repositories\ActeAcademiqueRepository;
use App\Repositories\AnneeAcademiqueRepository;
use App\Repositories\AttestationDefinitiveRepository;
use App\Repositories\CategorieActeRepository;
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
    protected $categorieActeRepository;
    protected $pdfCreator;

    public function __construct(InstitutionRepository $institutionRepo, 
                                ParcoursRepository $parcoursRepo, 
                                NiveauEtudeRepository $niveauRepo,
                                AnneeAcademiqueRepository $anneeRepo,
                                ActeAcademiqueRepository $attestationRepo,
                                ResultatAcademiqueRepository $resultatRepo,
                                EtudiantRepository $impetrantRepo,
                                NumeroteurRepository $numeroteurRepo,
                                CategorieActeRepository $categorieActeRepo,
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
        $this->categorieActeRepository = $categorieActeRepo;
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
        
        $categorieActeProvisoire = $this->categorieActeRepository->findByIntitule("DIPLOME");

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
        return view("metiers.actes.diplomes.index", compact('attestations', 'institution', 'annees', 'niveaux', 'parcours'));
    }


     /**
     * Afficher le doucment pdf 
     **/

     public function generer($acte_id){

        $attestation = $this->attestationRepository->find($acte_id);        
        $document_path = null;
        if(isset($attestation->documents) && count($attestation->documents) >50) {
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

            if(count($institution->visaInstitutions) < 1) return back()->with('reponse', 'Visas pour le diplôme non configuré');

            $document_path = $this->pdfCreator->createDiplome($institution, $timbre, $parcours, $etudiant, $signataireActe, $attestation, $resultat);
        
        }
        
        return Response::make(file_get_contents(public_path($document_path)), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$attestation->reference.'"'
            ]);
    }
    
   

}