<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\ParcoursRepository;
use App\Http\Requests\StoreParcoursRequest;
use App\Http\Requests\UpdateParcoursRequest;
use App\Repositories\FiliereRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\NiveauEtudeRepository;
use Illuminate\Support\Facades\Auth;

class ParcoursController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;
    private $filiereRepository;
    private $niveauEtudeRepository;
    private $institutionRepository;

    public function __construct(
        ParcoursRepository $parcoursRepo, 
        FiliereRepository $filiereRepo, 
        NiveauEtudeRepository $niveauRepo,
        InstitutionRepository $institutionRepo,
        )
    {
        $this->filiereRepository = $filiereRepo;
        $this->modelRepository = $parcoursRepo;
        $this->niveauEtudeRepository = $niveauRepo;
        $this->institutionRepository = $institutionRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(?string $niveau_id=null)
    {
        $parcours = [];
        
        $institution = Auth::user()->institution;
        if(isset($_GET['niveau_id'])){
            $niveau_id = $_GET['niveau_id'];            
        }
        if($niveau_id!=null){
            $niveau = $this->niveauEtudeRepository->find($niveau_id);
            if(!empty($institution)){
                if($institution->type === "IESR"){
                    $parcours = $this->modelRepository->findByIesrAndNiveau($institution->id, $niveau->id); 
                }
                else{
                    $parcours = $this->modelRepository->findByInstitutionAndNiveau($institution->id, $niveau->id);            
                }
            }
            
            else {
                $parcours = $this->modelRepository->findByNiveau($niveau->id);
            }
        }
        else {
        if(!empty($institution)){
            if($institution->type === "IESR"){
                $parcours = $this->modelRepository->findByIesr($institution->id); 
            }
            else{
                $parcours = $this->modelRepository->findByInstitution($institution->id);            
            }
        }
        
        else {
            $parcours = $this->modelRepository->all();
        }
    }
        $niveaux = $this->niveauEtudeRepository->all();
        
        return view('backend.parcours.index', compact('parcours', 'niveaux'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(?string $filiere_id=null)
    {
        $institution = Auth::user()->institution;        
        $filieres = null;
        $niveaux = $this->niveauEtudeRepository->all();        
        if(!empty($institution)){
            if($institution->type === "IESR"){
                $filieres = $this->filiereRepository->findByIesr($institution->id); 
            }
            else{
                $filieres = $this->filiereRepository->findByEtablissement($institution->id);             
            }
        }
        
        else {
            $filieres = $this->filiereRepository->all();        
        }
        if($filiere_id != null) {
            $filiere = $this->filiereRepository->find($filiere_id);
            return view('backend.parcours.create', compact('filiere', 'niveaux'));
        }
        else {
            return view('backend.parcours.create', compact('filieres', 'niveaux'));
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreParcoursRequest $request)
    {
        $input = $request->all();

        $parcours = $this->modelRepository->create($input);

        //Flash::success('parcours enregistré avec succès.');

        return redirect(route('parcours.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $parcours = $this->modelRepository->find($id);

        if (empty($parcours)) {
            //Flash::error('parcours not found');

            return redirect(route('parcours.index'));
        }

        return view('backend.parcours.show')->with('parcours', $parcours);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $parcours = $this->modelRepository->find($id);

        if (empty($parcours)) {
            return back()->with('response', 'Parcours non trouvé !');
        }

        $institution = Auth::user()->institution;        
        $filieres = null;
        $niveaux = $this->niveauEtudeRepository->all();        
        if(!empty($institution)){
            if($institution->type === "IESR"){
                $filieres = $this->filiereRepository->findByIesr($institution->id); 
            }
            else{
                $filieres = $this->filiereRepository->findByEtablissement($institution->id);             
            }
        }
        
        else {
            $filieres = $this->filiereRepository->all();        
        }
        return view('backend.parcours.edit', compact('parcours', 'filieres', 'niveaux'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParcoursRequest $request, string $id)
    {
        $parcours = $this->modelRepository->find($id);

        if (empty($parcours)) {
            //Flash::error('parcours not found');

            return redirect(route('parcours.index'));
        }

        $parcours = $this->modelRepository->update($request->all(), $id);

        //Flash::success('parcours modifié avec succès.');

        return redirect(route('parcours.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $parcours = $this->modelRepository->find($id);

        if (empty($parcours)) {
            $message = "parcours introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        return redirect(route('parcours.index'));
    }
}
