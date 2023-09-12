<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\ResultatAcademiqueDataTable;
use App\Repositories\ResultatAcademiqueRepository;
use App\Http\Requests\StoreResultatAcademiqueRequest;
use App\Http\Requests\UpdateResultatAcademiqueRequest;

class ResultatAcademiqueController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;

    public function __construct(ResultatAcademiqueRepository $ResultatAcademiqueRepo)
    {
        $this->modelRepository = $ResultatAcademiqueRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(ResultatAcademiqueDataTable $dataTable)
    {
        return $dataTable->render('backend.resultat_academiques.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.ResultatAcademique.create') ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResultatAcademiqueRequest $request)
    {
        $input = $request->all();

        $resultat = $this->modelRepository->create($input);

        //Flash::success('resultat enregistré avec succès.');

        return redirect(route('resultat_academiques.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $resultat = $this->modelRepository->find($id);

        if (empty($resultat)) {
            //Flash::error('resultat not found');

            return redirect(route('resultat_academiques.index'));
        }

        return view('backend.resultat_academiques.show')->with('resultat', $resultat);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $resultat = $this->modelRepository->find($id);

        if (empty($resultat)) {
            //Flash::error('resultat not found');

            return redirect(route('resultat_academiques.index'));
        }

        return view('backend.resultat_academiques.edit')->with('resultat', $resultat);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResultatAcademiqueRequest $request, string $id)
    {
        $resultat = $this->modelRepository->find($id);

        if (empty($resultat)) {
            //Flash::error('resultat not found');

            return redirect(route('resultat_academiques.index'));
        }

        $resultat = $this->modelRepository->update($request->all(), $id);

        //Flash::success('resultat modifié avec succès.');

        return redirect(route('resultat_academiques.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resultat = $this->modelRepository->find($id);

        if (empty($resultat)) {
            $message = "resultat introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "resultat supprimé avec succès";
        return $this->sendSuccessDialogResponse($message);
    }
}
