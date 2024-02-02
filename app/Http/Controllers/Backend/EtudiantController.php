<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\EtudiantRepository;
use App\Http\Requests\StoreEtudiantRequest;
use App\Http\Requests\UpdateEtudiantRequest;
use Illuminate\Support\Facades\Auth;

class EtudiantController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;

    public function __construct(EtudiantRepository $etudiantRepo)
    {
        $this->modelRepository = $etudiantRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudiants = null;
        $institution = Auth::user()->institution;
        if(!empty($institution)){
            if($institution->type === "IESR"){
                $etudiants = $this->modelRepository->findByIesr($institution->id); 
            }
            else{
                $etudiants = $this->modelRepository->findByEtablissement($institution->id);            
            }
        }
        
        else {
            $etudiants = $this->modelRepository->all();
        }
        return view('backend.etudiants.index', compact('etudiants'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.etudiants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEtudiantRequest $request)
    {
        $input = $request->all();
        $input['nom'] = strtoupper($input['nom']);
        $etudiant = $this->modelRepository->create($input);

        return redirect(route('etudiants.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $etudiant = $this->modelRepository->find($id);

        if (empty($etudiant)) {
            return redirect(route('etudiants.index'));
        }

        return view('backend.etudiants.show')->with('etudiant', $etudiant);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $etudiant = $this->modelRepository->find($id);

        if (empty($etudiant)) {
            return redirect(route('etudiants.index'));
        }

        return view('backend.etudiants.edit')->with('etudiant', $etudiant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEtudiantRequest $request, string $id)
    {
        $etudiant = $this->modelRepository->find($id);

        if (empty($etudiant)) {
            return redirect(route('etudiants.index'));
        }
        $input = $request->all();
        $input['nom'] = strtoupper($input['nom']);
        $etudiant = $this->modelRepository->update($input, $id);
        return redirect(route('etudiants.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $etudiant = $this->modelRepository->find($id);

        if (empty($etudiant)) {
            $message = "Etudiant introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "Etudiant supprimé avec succès";
        return $this->sendSuccessDialogResponse($message);
    }
}
