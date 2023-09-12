<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\SignataireEtablissementDataTable;
use App\Repositories\SignataireEtablissementRepository;
use App\Http\Requests\StoreSignataireEtablissementRequest;
use App\Http\Requests\UpdateSignataireEtablissementRequest;

class SignataireEtablissementController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;

    public function __construct(SignataireEtablissementRepository $signataireRepo)
    {
        $this->modelRepository = $signataireRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(SignataireEtablissementDataTable $dataTable)
    {
        return $dataTable->render('backend.signataire_etablissements.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.signataire_etablissements.create') ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSignataireEtablissementRequest $request)
    {
        $input = $request->all();

        $signataire = $this->modelRepository->create($input);

        //Flash::success('signataire enregistré avec succès.');

        return redirect(route('signataire_etablissements.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $signataire = $this->modelRepository->find($id);

        if (empty($signataire)) {
            //Flash::error('signataire not found');

            return redirect(route('signataire_etablissements.index'));
        }

        return view('backend.signataire_etablissements.show')->with('signataire', $signataire);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $SignataireEtablissement = $this->modelRepository->find($id);

        if (empty($signataire)) {
            //Flash::error('signataire not found');

            return redirect(route('signataire_etablissements.index'));
        }

        return view('backend.signataire_etablissements.edit')->with('signataire', $signataire);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSignataireEtablissementRequest $request, string $id)
    {
        $signataire = $this->modelRepository->find($id);

        if (empty($signataire)) {
            //Flash::error('signataire not found');

            return redirect(route('signataire_etablissements.index'));
        }

        $signataire = $this->modelRepository->update($request->all(), $id);

        //Flash::success('signataire modifié avec succès.');

        return redirect(route('signataire_etablissements.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $signataire = $this->modelRepository->find($id);

        if (empty($signataire)) {
            $message = "signataire introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "signataire supprimé avec succès";
        return $this->sendSuccessDialogResponse($message);
    }
}
