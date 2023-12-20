<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Repositories\FiliereRepository;
use App\Http\Requests\StoreFiliereRequest ;
use App\Http\Requests\UpdateFiliereRequest ;
use App\Repositories\InstitutionRepository;


class FiliereController extends Controller
{
    /** @var  modelRepository */ 
    private $modelRepository;
    private $institutionRepository;

    public function __construct(
        FiliereRepository $filiereRepo,
        InstitutionRepository $institutionRepo
        )
    {
        $this->modelRepository = $filiereRepo;
        $this->institutionRepository = $institutionRepo;
    }

    public function index()
    {
        $filieres = $this->modelRepository->all();
        return view('backend.filieres.index', compact('filieres'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        $institutions = $this->institutionRepository->all();
        return view('backend.filieres.create', compact('institutions'));
    }

    /** 
     * Store a newly created resource in storage.
     */
    public function store(StoreFiliereRequest $request)
    {
        $validated = $request->validated();
        $input = $request->all();

        $filiere = $this->modelRepository->create($input);

        return redirect(route('filieres.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $filiere = $this->modelRepository->find($id);

        if (empty($filiere)) {
            return redirect(route('filieres.index'));
        }

        return view('backend.filieres.show')->with('filiere', $filiere);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $filiere = $this->modelRepository->find($id);

        if (empty($filiere)) {
            return redirect(route('filieres.index'));
        }

        return view('backend.filieres.edit')->with('filiere', $filiere);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFiliereRequest $request, string $id)
    {
        $validated = $request->validated();
        $input = $request->all();
        $filiere = $this->modelRepository->find($id);

        if (empty($filiere)) {
            return redirect(route('filieres.index'));
        }
        
        $filiere = $this->modelRepository->update($input, $id);
        return redirect(route('filieres.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $filiere = $this->modelRepository->find($id);

        if (empty($filiere)) {
            $message = "Filière introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "Filière supprimée avec succès";
        return redirect(route('filieres.index'));
    }

}
