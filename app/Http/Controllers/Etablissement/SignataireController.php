<?php

namespace App\Http\Controllers\Etablissement;

use App\Http\Controllers\Controller;
use App\Models\InstitutionSignataire;
use App\Repositories\InstitutionRepository;
use App\Repositories\SignataireRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignataireController extends Controller
{
    protected $institutionRepository;
    protected $signataireRepository ;

    public function __construct(InstitutionRepository $institutionRepo, SignataireRepository $signataireRepo)
    {
        $this->institutionRepository = $institutionRepo;
        $this->signataireRepository = $signataireRepo;
    }


    /**
     * Lister les signaitaires de l'établissement
     **/
    public function listSignataires($institution_id)
    {
        //$institution = Auth ::user()->institution;
        $institution = $this->institutionRepository->find($institution_id);
        $signataires = $institution->signataires;
        
        return view('metiers.etablissements.list_signataires', compact('signataires'));
    }

    /**
     * Ajouter un signataire
     **/
    public function addSignataire()
    {
        $institution = Auth ::user()->institution;
        return view('metiers.etablissements.add_signataire', compact('institution'));
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

        $institutionSignataire = new InstitutionSignataire();
        $institutionSignataire->signataire_id = $signataire->id;
        $institutionSignataire->institution_id = $institution->id ;
        $institutionSignataire->typeDocument = "Attestation Provisoire";
        //$institutionSignataire->statut = 
        $institutionSignataire->debut = date('Y-m-d');
        $institutionSignataire->save();
        return redirect(route('metiers.etablissements.signataire-list', $institution->id));
    }

}
