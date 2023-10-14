<?php

namespace App\Http\Controllers\Metiers;

use App\Http\Controllers\Controller;
use App\Repositories\AttestationProvisoireRepository;
use App\Repositories\NiveauEtudeRepository;
use App\Repositories\ParcoursRepository;
use App\Repositories\SignataireRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttestationProvisoireController extends Controller
{
    protected $attestationRepository ;
    protected $parcoursRepository;
    protected $niveauRepository;
    protected $signataireRepository;

    public function __construct(
        AttestationProvisoireRepository $attestationRepo,
        ParcoursRepository $parcoursRepo,
        NiveauEtudeRepository $niveauRepo,
        SignataireRepository $signataireRepo,
         )
    {
        $this->attestationRepository = $attestationRepo;
        $this->parcoursRepository = $parcoursRepo;
        $this->niveauRepository = $niveauRepo;
        $this->signataireRepository = $signataireRepo;
    }
    /** 
    * Afficher les parcours de son etablissement
    **/
    public function listParcours()
    {
        $institution = Auth ::user()->institution;
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
        $niveaux = $this->niveauRepository->all();
        return view('metiers.etablissements.add_parcours', compact('niveaux'));
    }

    /** 
    * Enregistrer les données saisi dans le formulaire
    **/
    public function storeParcours(Request $request)
    {
        
        return redirect(route('metiers.etablissements.parours-list'));
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
    public function listEtudiants()
    {
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
    public function storeEtudiant()
    {
        return redirect(route('metiers.etablissements.etudiant-list'));
    }



    /**
     * Lister les signaitaires de l'établissement
     **/
    public function listSignataires()
    {
        $institution = Auth ::user()->institution;
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
     * Ajouter un étudiant
     **/
    public function addSignataire()
    {
        return view('metiers.etablissements.add_signataire');
    }

    /**
     * enregistrer les données du formulaire d'ajout d'étudiant
     **/
    public function storeSignataire()
    {
        return redirect(route('metiers.etablissements.signataire-list'));
    }

}
