<?php

namespace App\Http\Controllers\Metiers;

use App\Http\Controllers\Controller;
use App\Repositories\NumeroteurRepository;
use App\Repositories\SignataireActeRepository;
use App\Repositories\TimbreRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfigurationController extends Controller
{
    private $signataireRepository;
    private $numeroteurRepository;
    private $timbreRepository;
    private $userRepository;

    public function __construct(UserRepository $userRepo, 
                SignataireActeRepository $signataireRepo, 
                NumeroteurRepository $numeroteurRepo, 
                TimbreRepository $timbreRepo)
    {
        $this->userRepository = $userRepo;
        $this->signataireRepository = $signataireRepo;
        $this->numeroteurRepository = $numeroteurRepo;
        $this->timbreRepository = $timbreRepo;
    }
    public function index(){
        $institution = Auth::user()->institution;

        $signataireActes = $this->signataireRepository->findByEtablissement($institution->id);
        $numeroteurs = $this->numeroteurRepository->findByEtablissement($institution->id);
        //$timbre = $this->timbreRepository->findByEtablissement($institution->id);
        //$utilisateurs = $this->userRepository->findByEtablissement($institution->id);

        return view("metiers.config.index", compact('signataireActes', 'numeroteurs'));
        //return view("metiers.config.index", compact('signataireActes', 'numeroteurs', 'timbre', 'utilisateurs'));
   
    }
}
