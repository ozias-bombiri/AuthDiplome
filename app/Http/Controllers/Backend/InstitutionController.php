<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\InstitutionRepository;
use App\Http\Requests\StoreInstitutionRequest;
use App\Http\Requests\UpdateInstitutionRequest;


class InstitutionController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;
    
    public function __construct(InstitutionRepository $institutionRepo)
    {
        $this->modelRepository = $institutionRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.institutions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $iesrs = $this->modelRepository->findByType('IESR');
        return view('backend.institutions.create', compact('iesrs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstitutionRequest $request)
    {
        $input = $request->all();

        $institution = $this->modelRepository->create($input);

        //Flash::success('institution enregistré avec succès.');

        return redirect(route('institutions.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $institution = $this->modelRepository->find($id);

        if (empty($institution)) {
            //Flash::error('institution not found');

            return redirect(route('institutions.index'));
        }

        return view('backend.institutions.show')->with('institution', $institution);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $institution = $this->modelRepository->find($id);

        if (empty($institution)) {
            //Flash::error('institution not found');

            return redirect(route('institutions.index'));
        }

        return view('backend.institutions.edit')->with('institution', $institution);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateinstitutionRequest $request, string $id)
    {
        $institution = $this->modelRepository->find($id);

        if (empty($institution)) {
            //Flash::error('institution not found');

            return redirect(route('institutions.index'));
        }

        $institution = $this->modelRepository->update($request->all(), $id);
        
        return redirect(route('institutions.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $institution = $this->modelRepository->find($id);

        if (empty($institution)) {
            $message = "institution introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "institution supprimé avec succès";
        return $this->sendSuccessDialogResponse($message);
    }
}
