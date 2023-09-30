<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\SignataireDataTable;
use App\Repositories\SignataireRepository;
use App\Http\Requests\StoreSignataireRequest;
use App\Http\Requests\UpdateSignataireRequest;
use App\Repositories\InstitutionRepository;

class SignataireController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;
    private $institutionRepository;

    public function __construct(SignataireRepository $signataireRepo, InstitutionRepository $institutionRepo)
    {
        $this->modelRepository = $signataireRepo;
        $this->institutionRepository = $institutionRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.signataires.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $institutions = $this->institutionRepository->all();
        return view('backend.signataires.create', compact('institutions')) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSignataireRequest $request)
    {
        $input = $request->all();

        $signataire = $this->modelRepository->create($input);

        //Flash::success('signataire enregistré avec succès.');

        return redirect(route('signataires.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $signataire = $this->modelRepository->find($id);

        if (empty($signataire)) {
            //Flash::error('signataire not found');

            return redirect(route('signataires.index'));
        }

        return view('backend.signataires.show')->with('signataire', $signataire);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Signataire = $this->modelRepository->find($id);

        if (empty($signataire)) {
            //Flash::error('signataire not found');

            return redirect(route('signataires.index'));
        }

        return view('backend.signataires.edit')->with('signataire', $signataire);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSignataireRequest $request, string $id)
    {
        $signataire = $this->modelRepository->find($id);

        if (empty($signataire)) {
            //Flash::error('signataire not found');

            return redirect(route('signataires.index'));
        }

        $signataire = $this->modelRepository->update($request->all(), $id);

        //Flash::success('signataire modifié avec succès.');

        return redirect(route('signataires.index'));
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
