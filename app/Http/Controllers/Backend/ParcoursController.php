<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\ParcoursRepository;
use App\Http\Requests\StoreParcoursRequest;
use App\Http\Requests\UpdateParcoursRequest;
use App\Repositories\FiliereRepository;
use App\Repositories\NiveauEtudeRepository;

class ParcoursController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;
    private $filiereRepository;
    private $niveauEtudeRepository;

    public function __construct(
        ParcoursRepository $parcoursRepo, 
        FiliereRepository $filiereRepo, 
        NiveauEtudeRepository $niveauRepo
        )
    {
        $this->filiereRepository = $filiereRepo;
        $this->modelRepository = $parcoursRepo;
        $this->niveauEtudeRepository = $niveauRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parcours = [];
        
        if(isset($_GET['etablissement_id'])){
            $institution_id = $_GET['etablissement_id'];
            $parcours = $this->modelRepository->findByInstitution($institution_id);
        
        }
        else if(isset($_GET['iesr_id'])){
            $institution_id = $_GET['iesr_id'];
            $parcours = $this->modelRepository->findByIesr($institution_id);
        }
        else{
            $parcours = $this->modelRepository->all();
        }

        return view('backend.parcours.index', compact('parcours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $filieres = $this->filiereRepository->all();
        $niveaux = $this->niveauEtudeRepository->all();
        return view('backend.parcours.create', compact('filieres', 'niveaux')) ;
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
        $filieres = $this->filiereRepository->all();
        $niveaux = $this->niveauEtudeRepository->all();
        $parcours = $this->modelRepository->find($id);

        if (empty($parcours)) {
            //Flash::error('parcours not found');

            return redirect(route('parcours.index'));
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
