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

    public function rechercher(){

        return view('metiers.authentification.recherche');
    }
}
