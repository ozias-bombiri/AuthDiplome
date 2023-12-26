<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Repositories\VisaInstitutionRepository;
use App\Http\Requests\StoreVisaInstitutionRequest ;
use App\Http\Requests\UpdateVisaInstitutionRequest ;
use App\Repositories\CategorieActeRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\VisaDiplomeRepository;
use App\Repositories\VisaRepository;
use Illuminate\Http\Request;

class VisaInstitutionController extends Controller
{
    /** @var  modelRepository */ 
    private $modelRepository;
    private $categorieActeRepository;
    private $institutionRepository;
    private $visaRepository;
    private $visaDiplomeRepository;

    public function __construct(
        VisaInstitutionRepository $visaInstitutionRepo,
        CategorieActeRepository $categorieRepo,
        InstitutionRepository $institutionRepo,
        VisaRepository $visaRepo,
        VisaDiplomeRepository $visaDiplomeRepo
        )
    {
        $this->modelRepository = $visaInstitutionRepo;
        $this->categorieActeRepository = $categorieRepo;
        $this->institutionRepository = $institutionRepo;
        $this->visaRepository = $visaRepo;
        $this->visaDiplomeRepository = $visaDiplomeRepo;
    }

    public function index()
    {
        $visaInstitutions = $this->modelRepository->all();
        return view('backend.visa_institutions.index', compact('visaInstitutions'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create() 
    {
        $categorieActe = $this->categorieActeRepository->findByIntitule('DIPLOME');
        $institutions = $this->institutionRepository->findByType('IESR');
        return view('backend.visa_institutions.create', compact('categorieActe', 'institutions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function configVisas($id) 
    {
        $visaInstitution = $this->modelRepository->find($id);
        $visas = $this->visaRepository->all();
        return view('backend.visa_institutions.configVisas', compact('visaInstitution', 'visas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function storeConfigVisas(Request $request) 
    {
        $input = $request->all();
        $visaInstitution = $this->modelRepository->find($input['visaInstitution_id']);
        $visasChecked = $input['visas'];
        //dd($visasChecked);
        $ordre = 1;
        foreach($visasChecked as $visaId){
            $visadiplome = [];
            $visadiplome['visaInstitution_id'] =  $visaInstitution->id;
            $visadiplome['visa_id'] = $visaId;
            $visadiplome['ordre'] = $ordre ++;
            $this->visaDiplomeRepository->create($visadiplome);
        }
        return redirect(route('visa_institutions.show', $visaInstitution->id));
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
        $visaInstitution = $this->modelRepository->find($id);
        $visas = $this->visaRepository->findByVisaInstitution($visaInstitution->id);
        //dd($visas);
        if (empty($visaInstitution)) {
            return redirect(route('visa_institutions.index'));
        }

        return view('backend.visa_institutions.show', compact('visaInstitution', 'visas'));

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
