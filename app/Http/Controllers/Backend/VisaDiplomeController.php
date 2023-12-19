<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Repositories\VisaDiplomeRepository;
use App\Http\Requests\StoreVisaDiplomeRequest ;
use App\Http\Requests\UpdateVisaDiplomeRequest ;
use App\Repositories\VisaRepository;
use App\Repositories\VisaInstitutionRepository;



class VisaDiplomeController extends Controller
{
    /** @var  modelRepository */ 
    private $modelRepository; 
    private $visaRepository;
    private $visaInstitutionRepository;

    public function __construct(
        VisaDiplomeRepository $visaDiplomeRepo,
        VisaRepository $visaRepo,
        VisaInstitutionRepository $visaInstitutionRepo
        )
    {
        $this->modelRepository = $visaDiplomeRepo;
        $this->visaRepository = $visaRepo;
        $this->visaInstitutionRepository = $visaInstitutionRepo;
    }

    public function index()
    {
        $visa_diplomes = $this->modelRepository->all();
        return view('backend.visa_diplomes.index', compact('visa_diplomes'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $visas = $this->visaRepository->all();
        $visaInstitutions = $this->visaInstitutionRepository->all();
        return view('backend.visa_diplomes.create',compact('visas', 'visaInstitutions'));
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVisaDiplomeRequest $request)
    {
        $validated = $request->validated();
        $input = $request->all();

        $visa_diplome = $this->modelRepository->create($input);

        return redirect(route('visa_diplomes.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $visa_diplome = $this->modelRepository->find($id);

        if (empty($visa_diplome)) {
            return redirect(route('visa_diplomes.index'));
        }

        return view('backend.visa_diplomes.show')->with('visa_diplome', $visa_diplome);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $visa_diplome = $this->modelRepository->find($id);

        if (empty($visa_diplome)) {
            return redirect(route('visa_diplomes.index'));
        }

        return view('backend.visa_diplomes.edit')->with('visa_diplome', $visa_diplome);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVisaDiplomeRequest $request, string $id)
    {
        $validated = $request->validated();
        $input = $request->all();
        $visa_diplome = $this->modelRepository->find($id);

        if (empty($visa_diplome)) {
            return redirect(route('visa_diplomes.index'));
        }
        
        $visa_diplome = $this->modelRepository->update($input, $id);
        return redirect(route('visa_diplomes.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $visa_diplome = $this->modelRepository->find($id);

        if (empty($visa_diplome)) {
            $message = "Visa diplome introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "Visa diplome supprimé avec succès";
        return redirect(route('visa_diplomes.index'));
    }

}
