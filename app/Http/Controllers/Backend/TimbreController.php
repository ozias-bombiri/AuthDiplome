<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\TimbreRepository;
use App\Http\Requests\StoreTimbreRequest;
use App\Http\Requests\UpdateTimbreRequest;
use App\Repositories\InstitutionRepository;
use App\Repositories\MinistereRepository;
use App\Repositories\SignataireRepository;
use Illuminate\Support\Facades\Auth;

class TimbreController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;
    private $institutionRepository;
    private $ministereRepository;
    private $signataireRepository;

    public function __construct(TimbreRepository $timbreRepo, 
                        InstitutionRepository $institutionRepo,
                        MinistereRepository $ministereRepo,
                        SignataireRepository $signataireRepo)
    {
        $this->modelRepository = $timbreRepo;
        $this->institutionRepository = $institutionRepo;
        $this->ministereRepository = $ministereRepo;
        $this->signataireRepository = $signataireRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timbres = null;
        $institution = Auth::user()->institution;
        if(!empty($institution)){
            if($institution->type === "IESR"){
                $timbres = $this->modelRepository->findByIesr($institution->id); 
            }
            else{
                $timbres = $this->modelRepository->findByEtablissement($institution->id);            
            }
        }
        
        else {
            $timbres = $this->modelRepository->all();
        }
        
        return view('backend.timbres.index', compact('timbres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $institution = Auth::user()->institution;
        $ministeres = $this->ministereRepository->all();
        
        $institutions = null;
        if(!empty($institution)){
            if($institution->type === "IESR"){
                $institutions = $this->institutionRepository->findEtablissement($institution->id); 
            }
            else{
                $institutions = null;            
            }
        }
        
        else {
            $institutions = $this->institutionRepository->all();
        }
        if($institutions == null){
            return view('backend.timbres.create', compact('institution', 'ministeres'));
        }
        else {
            return view('backend.timbres.create', compact('institutions','ministeres'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTimbreRequest $request)
    {
        $validated = $request->validated();
        $input = $request->all();
        //$institution = $this->institutionRepository->find($input['institution_id']);
        
        $timbre = $this->modelRepository->create($input);

        return redirect(route('timbres.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $timbre = $this->modelRepository->find($id);

        if (empty($timbre)) {
            //Flash::error('timbre not found');

            return redirect(route('timbres.index'));
        }

        return view('backend.timbres.show')->with('timbre', $timbre);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $timbre = $this->modelRepository->find($id);

        if (empty($timbre)) {
            
            return back()->with('reponse', 'Timbre non trouvé !');
        }
        $institution = Auth::user()->institution;
        $ministeres = $this->ministereRepository->all();
        
        $institutions = null;
        if(!empty($institution)){
            if($institution->type === "IESR"){
                $institutions = $this->institutionRepository->findEtablissement($institution->id); 
            }
            else{
                $institutions = null;            
            }
        }
        
        else {
            $institutions = $this->institutionRepository->all();
        }
        if($institutions == null){
            return view('backend.timbres.edit', compact('timbre', 'institution', 'ministeres'));
        }
        else {
            return view('backend.timbres.edit', compact('timbre', 'institutions','ministeres'));
        }        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTimbreRequest $request, string $id)
    {
        $timbre = $this->modelRepository->find($id);

        if (empty($timbre)) {
            //Flash::error('timbre not found');

            return redirect(route('timbres.index'));
        }

        $timbre = $this->modelRepository->update($request->all(), $id);

        //Flash::success('timbre modifié avec succès.');

        return redirect(route('timbres.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $timbre = $this->modelRepository->find($id);

        if (empty($timbre)) {
            $message = "timbre introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "timbre supprimé avec succès";
        return redirect(route('timbres.index'));
    }
}
