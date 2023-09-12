<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\AttestationDefinitiveDataTable;
use App\Repositories\AttestationDefinitiveRepository;
use App\http\Requests\StoreAttestationDefinitiveRequest ;
use App\http\Requests\UpdateAttestationDefinitiveRequest ;

class AttestationDefinitiveController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;

    public function __construct(AttestationDefinitiveRepository $attestationDefinitiveRepo)
    {
        $this->modelRepository = $attestationDefinitiveRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(AttestationDefinitiveDataTable $dataTable)
    {
        return $dataTable->render('backend.attestation_definitives.index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.attestation_definitives.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttestationDefinitiveRequest $request)
    {
        $input = $request->all();

        $attestation = $this->modelRepository->create($input);

        //Flash::success('Année enregistré avec succès.');

        return redirect(route('attestation_definitives.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $attestationDefinitive = $this->modelRepository->find($id);

        if (empty($attestationDefinitive)) {
            //Flash::error('Année not found');

            return redirect(route('attestation_definitives.index'));
        }

        return view('backend.attestation_definitives.show')->with('attestation', $attestationDefinitive);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $attestationDefinitive = $this->modelRepository->find($id);

        if (empty($attestationDefinitive)) {
            //Flash::error('Année not found');

            return redirect(route('attestation_definitives.index'));
        }

        return view('backend.attestation_definitives.edit')->with('attestation', $attestationDefinitive);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttestationDefinitiveRequest $request, string $id)
    {
        $attestation = $this->modelRepository->find($id);

        if (empty($attestation)) {
            //Flash::error('Année not found');

            return redirect(route('attestation_definitives.index'));
        }

        $attestation = $this->modelRepository->update($request->all(), $id);

        Flash::success('Attestation définitive modifié avec succès.');

        return redirect(route('attestation_definitives.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attestation = $this->modelRepository->find($id);

        if (empty($attestation)) {
            $message = "Attestation définitive introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "Attestation définitive supprimé avec succès";
        return $this->sendSuccessDialogResponse($message);
    }
}
