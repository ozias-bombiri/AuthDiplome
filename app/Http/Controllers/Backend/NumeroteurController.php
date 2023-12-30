<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\InstitutionRepository;
use App\Repositories\CategorieActeRepository;
use App\Repositories\NumeroteurRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NumeroteurController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;
    private $institutionRepository;
    private $categorieRepository;

    public function __construct(
        NumeroteurRepository $anneeRepo, 
        InstitutionRepository $institutionRepo,
        CategorieActeRepository $categorieRepo,
        )
    {
        $this->modelRepository = $anneeRepo;
        $this->categorieRepository = $categorieRepo;
        $this->institutionRepository = $institutionRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $numeroteurs = null;
        $institution = Auth::user()->institution;
        if(!empty($institution)){
            if($institution->type === "IESR"){
                $numeroteurs = $this->modelRepository->findByIesr($institution->id); 
            }
            else{
                $numeroteurs = $this->modelRepository->findByEtablissement($institution->id);            
            }
        }
        
        else {
            $numeroteurs = $this->modelRepository->all();
        }
        return view('backend.numeroteurs.index', compact('numeroteurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $institution = Auth::user()->institution;
        $institutions = null;
        if(!empty($institution)){
            if($institution->type === "IESR"){
                $institutions = $this->institutionRepository->findEtablissement($institution->id); 
            }
            else{
                $institutions = null;            
            }
        }
        
        else {
            $institutions = $this->institutionRepository->all();
        }
        if($institutions == null){
            $categorie = $this->categorieRepository->findByIntitule('PROVISOIRE');
            return view('backend.numeroteurs.create', compact('institution','categorie'));
        }
        else {
            $categories = $this->categorieRepository->all();        
            return view('backend.numeroteurs.create', compact('institutions','categories'));
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['compteur'] = 0;

        $numeroteur = $this->modelRepository->create($input);

        return redirect(route('numeroteurs.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $numeroteur = $this->modelRepository->find($id);

        if (empty($numeroteur)) {
            return back()->with('reponse', 'Numeroteur non trouvé !');
        }
        $institution = Auth::user()->institution;
        $institutions = null;
        if(!empty($institution)){
            if($institution->type === "IESR"){
                $institutions = $this->institutionRepository->findEtablissement($institution->id); 
            }
            else{
                $institutions = null;            
            }
        }
        
        else {
            $institutions = $this->institutionRepository->all();
        }
        if($institutions == null){
            $categorie = $this->categorieRepository->findByIntitule('PROVISOIRE');
            return view('backend.numeroteurs.edit', compact('numeroteur', 'institution','categorie'));
        }
        else {
            $categories = $this->categorieRepository->all();        
            return view('backend.numeroteurs.edit', compact('numeroteur', 'institutions','categories'));
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();
        $numeroteur = $this->modelRepository->find($id);

        if (empty($numeroteur)) {
            return redirect(route('annee_academiques.index'));
        }
        
        $numeroteur = $this->modelRepository->update($input, $id);
        return redirect(route('numeroteurs.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $numeroteur = $this->modelRepository->find($id);

        if (empty($numeroteur)) {
            $message = "Numeroteur introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "Numeroteur supprimé avec succès";
        return redirect(route('numeroteurs.index'));
    }
}
