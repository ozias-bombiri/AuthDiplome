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

    


}