<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\EtablissementDataTable;
use App\Repositories\EtablissementRepository;
use App\Http\Requests\StoreEtablissementRequest;
use App\Http\Requests\UpdateEtablissementRequest;
use Flash;


class EtablissementController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;

    public function __construct(EtablissementRepository $etablissementRepo)
    {
        $this->modelRepository = $etablissementRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(EtablissementDataTable $dataTable)
    {
        return $dataTable->render('backend.etablissements.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.etablissements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEtablissementRequest $request)
    {
        $input = $request->all();

        $etablissement = $this->modelRepository->create($input);

        //Flash::success('Etablissement enregistré avec succès.');

        return redirect(route('etablissements.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $etablissement = $this->modelRepository->find($id);

        if (empty($etablissement)) {
            //Flash::error('Etablissement not found');

            return redirect(route('etablissements.index'));
        }

        return view('backend.etablissements.show')->with('etablissement', $etablissement);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $etablissement = $this->modelRepository->find($id);

        if (empty($etablissement)) {
            //Flash::error('Etablissement not found');

            return redirect(route('etablissements.index'));
        }

        return view('backend.etablissements.edit')->with('etablissement', $etablissement);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEtablissementRequest $request, string $id)
    {
        $etablissement = $this->modelRepository->find($id);

        if (empty($etablissement)) {
            //Flash::error('Etablissement not found');

            return redirect(route('etablissements.index'));
        }

        $etablissement = $this->modelRepository->update($request->all(), $id);

        Flash::success('Etablissement modifié avec succès.');

        return redirect(route('etablissements.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $etablissement = $this->modelRepository->find($id);

        if (empty($etablissement)) {
            $message = "Etablissement introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "Etablissement supprimé avec succès";
        return $this->sendSuccessDialogResponse($message);
    }
}
