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
}
