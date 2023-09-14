<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\TimbreEtablissementDataTable;
use App\Repositories\TimbreEtablissementRepository;
use App\Http\Requests\StoreTimbreEtablissementRequest;
use App\Http\Requests\UpdateTimbreEtablissementRequest;

class TimbreEtablissementController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;

    public function __construct(TimbreEtablissementRepository $timbreRepo)
    {
        $this->modelRepository = $timbreRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(TimbreEtablissementDataTable $dataTable)
    {
        return $dataTable->render('backend.timbre_etablissements.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.timbre_etablissements.create') ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTimbreEtablissementRequest $request)
    {
        $input = $request->all();

        $timbre = $this->modelRepository->create($input);

        //Flash::success('timbre enregistré avec succès.');

        return redirect(route('timbre_etablissements.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $timbre = $this->modelRepository->find($id);

        if (empty($timbre)) {
            //Flash::error('timbre not found');

            return redirect(route('timbre_etablissements.index'));
        }

        return view('backend.timbre_etablissements.show')->with('timbre', $timbre);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $timbre = $this->modelRepository->find($id);

        if (empty($timbre)) {
            //Flash::error('timbre not found');

            return redirect(route('timbre_etablissements.index'));
        }

        return view('backend.timbre_etablissements.edit')->with('timbre', $timbre);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTimbreEtablissementRequest $request, string $id)
    {
        $timbre = $this->modelRepository->find($id);

        if (empty($timbre)) {
            //Flash::error('timbre not found');

            return redirect(route('timbre_etablissements.index'));
        }

        $timbre = $this->modelRepository->update($request->all(), $id);

        //Flash::success('timbre modifié avec succès.');

        return redirect(route('timbre_etablissements.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $timbre = $this->modelRepository->find($id);

        if (empty($timbre)) {
            $message = "timbre introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "timbre supprimé avec succès";
        return $this->sendSuccessDialogResponse($message);
    }
}
