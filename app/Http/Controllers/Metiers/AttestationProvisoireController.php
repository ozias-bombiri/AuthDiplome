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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function __construct(
        AttestationProvisoireRepository $attestationRepo,
        ParcoursRepository $parcoursRepo,
        NiveauEtudeRepository $niveauRepo,
        SignataireRepository $signataireRepo,
        InstitutionRepository $institutionRepo,
        ImpetrantRepository $etudtiantRepo,
        AnneeAcademiqueRepository $anneeRepo,
        ResultatAcademiqueRepository $resultatRepo
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
    }
    /** 
    * Afficher les parcours de son etablissement
    **/
    public function listParcours($institution_id)
    {
        $institution = $this->institutionRepository->find($institution_id);
        $parcours = null;
        if($institution && $institution->type !='IESR'){
            $parcours = $institution->parcours;
        }
        else {
            $parcours = $this->parcoursRepository->all();
        }
        return view('metiers.etablissements.list_parcours', compact('parcours'));
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
        $parcours = $this->parcoursRepository->create($input);
        return redirect(route('metiers.etablissements.parcours-list'));
    }

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
    public function listEtudiants($institution_id)
    {
        $institution = $this->institutionRepository->find($institution_id);
        
        $etudiants = $this->etudiantRepository->findByInstitution($institution->id);
        //$etudiants = $this->etudiantRepository->all();
        return view('metiers.etablissements.list_etudiants', compact('etudiants'));
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
        $input['institution_id'] = $institution->id ;
        $input['typeDocument'] = "Attestation Provisoire" ;
        $signataire = $this->signataireRepository->create($input);
        return redirect(route('metiers.etablissements.signataire-list', $institution->id));
    }

}
