<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Repositories\VisaInstitutionRepository;
use App\Http\Requests\StoreVisaInstitutionRequest ;
use App\Http\Requests\UpdateVisaInstitutionRequest ;
use App\Repositories\CategorieActeRepository;
use App\Repositories\InstitutionRepository;

class VisaInstitutionController extends Controller
{
    /** @var  modelRepository */ 
    private $modelRepository;
    private $categorieRepository;
    private $institutionRepository;

    public function __construct(
        VisaInstitutionRepository $visaInstitutionRepo,
        CategorieActeRepository $categorieRepo,
        InstitutionRepository $institutionRepo
        )
    {
        $this->modelRepository = $visaInstitutionRepo;
        $this->categorieRepository = $categorieRepo;
        $this->institutionRepository = $institutionRepo;
    }

    public function index()
    {
        $visa_institutions = $this->modelRepository->all();
        return view('backend.visa_institutions.index', compact('visa_institutions'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create() 
    {
        $categories = $this->categorieRepository->all();
        $institutions = $this->institutionRepository->all();
        return view('backend.visa_institutions.create', compact('categories', 'institutions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVisaInstitutionRequest $request)
    {
        $validated = $request->validated();
        $input = $request->all();

        $visa_institution = $this->modelRepository->create($input);

        return redirect(route('visa_institutions.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $visa_institution = $this->modelRepository->find($id);

        if (empty($visa_institution)) {
            return redirect(route('visa_institutions.index'));
        }

        return view('backend.visa_institutions.show')->with('visa_institution', $visa_institution);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $visa_institution = $this->modelRepository->find($id);

        if (empty($visa_institution)) {
            return redirect(route('visa_institutions.index'));
        }

        return view('backend.visa_institutions.edit')->with('visa_institution', $visa_institution);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreVisaInstitutionRequest $request, string $id)
    {
        $validated = $request->validated();
        $input = $request->all();
        $visa_institution = $this->modelRepository->find($id);

        if (empty($visa_institution)) {
            return redirect(route('visa_institutions.index'));
        }
        
        $visa_institution = $this->modelRepository->update($input, $id);
        return redirect(route('visa_institutions.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $visa_institution = $this->modelRepository->find($id);

        if (empty($visa_institution)) {
            $message = "Visa institution introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "Visa institution supprimé avec succès";
        return redirect(route('visa_institutions.index'));
    }

}
