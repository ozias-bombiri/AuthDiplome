<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\SignataireIesrDataTable;
use App\Repositories\SignataireIesrRepository;
use App\Http\Requests\StoreSignataireIesrRequest;
use App\Http\Requests\UpdateSignataireIesrRequest;
use App\Repositories\IesrRepository;

class SignataireIesrController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;
    private $iesrRepository;

    public function __construct(SignataireIesrRepository $signataireRepo, IesrRepository $iesrRepo)
    {
        
        $this->modelRepository = $signataireRepo;
        $this->iesrRepository = $iesrRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(SignataireIesrDataTable $dataTable)
    {
       
        return $dataTable->render('backend.signataire_iesrs.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $iesrs = $this->iesrRepository->all();
        return view('backend.signataire_iesrs.create', compact('iesrs')) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSignataireIesrRequest $request)
    {
        $input = $request->all();

        $signataire = $this->modelRepository->create($input);

        //Flash::success('signataire enregistré avec succès.');

        return redirect(route('signataire_iesrs.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $signataire = $this->modelRepository->find($id);

        if (empty($signataire)) {
            //Flash::error('signataire not found');

            return redirect(route('signataire_iesrs.index'));
        }

        return view('backend.signataire_iesrs.show')->with('signataire', $signataire);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $signataire = $this->modelRepository->find($id);

        if (empty($signataire)) {
            //Flash::error('signataire not found');

            return redirect(route('signataire_iesrs.index'));
        }

        return view('backend.signataire_iesrs.edit')->with('signataire', $signataire);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSignataireIesrRequest $request, string $id)
    {
        $signataire = $this->modelRepository->find($id);

        if (empty($signataire)) {
            //Flash::error('signataire not found');

            return redirect(route('signataire_iesrs.index'));
        }

        $signataire = $this->modelRepository->update($request->all(), $id);

        //Flash::success('signataire modifié avec succès.');

        return redirect(route('signataire_iesrs.index'));
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
