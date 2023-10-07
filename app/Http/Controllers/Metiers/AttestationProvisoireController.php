<?php

namespace App\Http\Controllers\Metiers;

use App\Http\Controllers\Controller;
use App\Repositories\AttestationProvisoireRepository;
use App\Repositories\NiveauEtudeRepository;
use App\Repositories\ParcoursRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttestationProvisoireController extends Controller
{
    protected $attestationRepository ;
    protected $parcoursRepository;
    protected $niveauRepository;

    public function __construct(
        AttestationProvisoireRepository $attestationRepo,
        ParcoursRepository $parcoursRepo,
        NiveauEtudeRepository $niveauRepo )
    {
        $this->attestationRepository = $attestationRepo;
        $this->parcoursRepository = $parcoursRepo;
        $this->niveauRepository = $niveauRepo;
    }
    /** 
    * Afficher les parcours de son etablissement
    **/
    public function listParcours()
    {
        $institution = Auth ::user()->institution;
        $parcours = $institution->parcours;
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
    * Ajouter un parcours de son etablissement
    **/
    public function storeParcours(Request $request)
    {
        
        return redirect(route('metiers.etablissements.parours-list'));
    }

    /**
     * Lister les attestations provisoires à partir du parcours de formation choisi
     **/
    public function listAttestation($parcours_id)
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
        return view('metiers.etablissements.list_signataires');
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
