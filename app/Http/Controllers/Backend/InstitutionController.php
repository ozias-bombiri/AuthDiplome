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
        $institutions = $this->modelRepository->all();
        return view('backend.institutions.index', compact('institutions'));
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
        $validated = $request->validated();
        $input = $request->all();
        if($request->file()) {
            $file = $request->file('logo');
            $fileName = 'logo_'.str_replace(array('/', '%', '@', '\'', ';', '<', '>' ), '-', $input['sigle']).'-'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/logos'), $fileName);
            $input['logo'] = $fileName;
        }
        if($input['type'] === 'IESR' || $input['parent_id'] === 'Aucun'){
            $input['parent_id'] = null;
        }
        $this->modelRepository->create($input);
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
        $path = 'uploads/logos/'.$institution->logo;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $logo_base64 = "";
        if(file_exists($path)) {
            $data = file_get_contents($path);
            $logo_base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }
        
        return view('backend.institutions.show', compact('institution', 'logo_base64') );
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
        $iesrs = $this->modelRepository->findByType('IESR');
        return view('backend.institutions.edit', compact('institution', 'iesrs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstitutionRequest $request, $id)
    {
        $institution = $this->modelRepository->find($id);

        if (empty($institution)) {
            //Flash::error('institution not found');

            return redirect(route('institutions.index'));
        }
        $validated = $request->validated();
        $input = $request->all();
        if($request->file()) {
            $file = $request->file('logo');
            $fileName = 'logo_'.str_replace(array('/', '%', '@', '\'', ';', '<', '>' ), '-', $input['sigle']).'-'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/logos'), $fileName);
            $input['logo'] = $fileName;
        }
        if($input['type'] === 'IESR' || $input['parent_id'] === "Aucun"){
            $input['parent_id'] = null;
        }
        $institution = $this->modelRepository->update($input, $id);
        
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
