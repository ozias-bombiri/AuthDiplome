<?php

namespace App\Http\Controllers\Metiers\Authentification;

use App\Http\Controllers\Controller;
use App\Repositories\AttestationDefinitiveRepository;
use App\Repositories\AttestationProvisoireRepository;
use App\Repositories\DiplomeRepository;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    private $attestationProvisoireRepository ;
    private $attestationDefinitiveRepository ;
    private $diplomeRepository ;

    public function __construct(AttestationProvisoireRepository $attestationProRepo, AttestationDefinitiveRepository $attestationDefRepo, DiplomeRepository $diplomeRepo)
    {
        $this->attestationProvisoireRepository = $attestationProRepo;
        $this->attestationDefinitiveRepository = $attestationDefRepo;
        $this->diplomeRepository = $diplomeRepo;
        
    }

    public function index(){

        return view('metiers.authentification.recherche');
    }

    public function rechercher(Request $request){
        $input = $request->all();
        $reference = $input['reference'];
        $categorie = $input['categorie'];
        $document =null;
        if ($categorie === "provisoire") {
            $document  = $this->attestationProvisoireRepository->findByReference($reference);
        }
        else if($categorie === "definitive"){
            $document = $this->attestationDefinitiveRepository->findByReference($reference);
        }
        else if($categorie === "diplome"){
            $document = $this->diplomeRepository->findByReference($reference);
        }
        else {

        }
        if(empty($document)){
            $message = "Aucun document trouvé !";
            return view('metiers.authentification.recherche', compact('message'));
        }

        return view('metiers.authentification.recherche', compact('categorie', 'document'));
    }

    public function visualiser(Request $request, $categorie, $document_id){
        if( $categorie = )

        $attestation = $this->attestationRepository->find($document_id);
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
        

        return view('metiers.authentification.recherche') ;
    }
}
