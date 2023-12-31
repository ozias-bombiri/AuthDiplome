<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Repositories\AnneeAcademiqueRepository;
use App\Http\Requests\StoreAnneeAcademiqueRequest ;
use App\Http\Requests\UpdateAnneeAcademiqueRequest ;
class AnneeacademiqueController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;

    public function __construct(AnneeacademiqueRepository $anneeRepo)
    {
        $this->modelRepository = $anneeRepo;
    }

    public function index()
    {
        $annees = $this->modelRepository->all();
        return view('backend.annee_academiques.index', compact('annees'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.annee_academiques.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnneeAcademiqueRequest $request)
    {
        $validated = $request->validated();
        $input = $request->all();

        $annee = $this->modelRepository->create($input);

        return redirect(route('annee_academiques.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $annee = $this->modelRepository->find($id);

        if (empty($annee)) {
            return redirect(route('annee_academiques.index'));
        }

        return view('backend.annee_academiques.show')->with('annee', $annee);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $annee = $this->modelRepository->find($id);

        if (empty($annee)) {
            return redirect(route('annee_academiques.index'));
        }

        return view('backend.annee_academiques.edit')->with('annee', $annee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnneeAcademiqueRequest $request, string $id)
    {
        $validated = $request->validated();
        $input = $request->all();
        $annee = $this->modelRepository->find($id);

        if (empty($annee)) {
            return redirect(route('annee_academiques.index'));
        }
        
        $annee = $this->modelRepository->update($input, $id);
        return redirect(route('annee_academiques.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $annee = $this->modelRepository->find($id);

        if (empty($annee)) {
            $message = "Année introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "Année supprimé avec succès";
        return redirect(route('annee_academiques.index'));
    }

}
