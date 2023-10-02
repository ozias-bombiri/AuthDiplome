<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\AttestationProvisoireRepository;
use App\http\Requests\StoreAttestationProvisoireRequest ;
use App\http\Requests\UpdateAttestationProvisoireRequest ;


class AttestationProvisoireController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;

    public function __construct(AttestationProvisoireRepository $attestationRepo)
    {
        $this->modelRepository = $attestationRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.attestation_provisoires.index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.attestation_provisoires.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttestationProvisoireRequest $request)
    {
        $input = $request->all();

        $attestation = $this->modelRepository->create($input);

        return redirect(route('attestation_provisoires.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $attestation = $this->modelRepository->find($id);

        if (empty($attestation)) {
            return redirect(route('attestation_provisoires.index'));
        }

        return view('backend.attestation_provisoires.show')->with('attestation', $attestation);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $attestation = $this->modelRepository->find($id);

        if (empty($attestation)) {
            return redirect(route('attestation_provisoires.index'));
        }

        return view('backend.attestation_provisoires.edit')->with('attestation', $attestation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttestationProvisoireRequest $request, string $id)
    {
        $attestation = $this->modelRepository->find($id);

        if (empty($attestation)) {
            return redirect(route('attestation_provisoires.index'));
        }

        $attestation = $this->modelRepository->update($request->all(), $id);
        return redirect(route('attestation_provisoires.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attestation = $this->modelRepository->find($id);

        if (empty($attestation)) {
            $message = "Année introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "Année supprimé avec succès";
        return $this->sendSuccessDialogResponse($message);
    }
}
