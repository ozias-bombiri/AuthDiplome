<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\NiveauEtudeRepository;
use App\Http\Requests\StoreNiveauEtudeRequest;
use App\Http\Requests\UpdateNiveauEtudeRequest;

class NiveauEtudeController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;

    public function __construct(NiveauetudeRepository $niveauRepo)
    {
        $this->modelRepository = $niveauRepo;
    }
  

    public function index(NiveauEtudeDataTable $dataTable)
    {
        $niveaux = $this->niveauEtudeRepository->all();
        return $dataTable->render('backend.niveau_etudes.index',  compact('niveaux'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.niveau_etudes.create') ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNiveauEtudeRequest $request)
    {
        $input = $request->all();

        $niveau = $this->modelRepository->create($input);

        //Flash::success('Niveau enregistré avec succès.');

        return redirect(route('niveau_etudes.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $niveau = $this->modelRepository->find($id);

        if (empty($niveau)) {
            //Flash::error('Niveau not found');

            return redirect(route('niveau_etudes.index'));
        }

        return view('backend.niveau_etudes.show')->with('niveau', $niveau);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $niveau = $this->modelRepository->find($id);

        if (empty($niveau)) {
            //Flash::error('Niveau not found');

            return redirect(route('niveau_etudes.index'));
        }

        return view('backend.niveau_etudes.edit')->with('niveau', $niveau);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNiveauEtudeRequest $request, string $id)
    {
        $niveau = $this->modelRepository->find($id);

        if (empty($niveau)) {
            //Flash::error('Niveau not found');

            return redirect(route('niveau_etudes.index'));
        }

        $niveau = $this->modelRepository->update($request->all(), $id);

        //Flash::success('Niveau modifié avec succès.');

        return redirect(route('niveau_etudes.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $niveau = $this->modelRepository->find($id);

        if (empty($niveau)) {
            $message = "Niveau introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "Niveau supprimé avec succès";
        return $this->sendSuccessDialogResponse($message);
    }
}
