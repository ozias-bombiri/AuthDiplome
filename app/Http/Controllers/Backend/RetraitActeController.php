<?php

namespace App\Http\Controllers\Backend; 

use App\Http\Controllers\Controller;

use App\Repositories\RetraitActeRepository;
use App\Http\Requests\StoreRetraitActeRequest ;
use App\Http\Requests\UpdateRetraitActeRequest ;
use App\Repositories\ActeAcademiqueRepository;
use App\Repositories\CategorieActeRepository;
use App\Repositories\InstitutionRepository;
use Illuminate\Support\Facades\Auth;

class RetraitActeController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository; 
    private $acteAcademiqueRepository;
    private $institutionRepository;
    private $categorieActeRepository;

    public function __construct(
        RetraitActeRepository $retraitRepo,
        ActeAcademiqueRepository $acteAcademiqueRepo,
        InstitutionRepository $institutionRepo,
        CategorieActeRepository $categorieActeRepo
        )
    {
        $this->modelRepository = $retraitRepo;
        $this->acteAcademiqueRepository = $acteAcademiqueRepo;
        $this->institutionRepository = $institutionRepo;
        $this->categorieActeRepository = $categorieActeRepo;
    }

    public function index1()
    {
        $institution = Auth::user()->institution;
      
        $retraits = null;
        
        $categorieActeProvisoire = $this->categorieActeRepository->findByIntitule("PROVISOIRE");
        if(!empty($institution)){
            if($institution->type =="IESR") {
                $retraits = $this->modelRepository->findByIesrAndCategorie($institution->id, $categorieActeProvisoire->id );        
            }
            else {
                $retraits = $this->modelRepository->findByEtablissementAndCategorie($institution->id, $categorieActeProvisoire->id );       
                //dd($retraits);
            }
        }
        else {
            $retraits = $this->modelRepository->all();
        }
        
        return view('backend.retrait_actes.index', compact('retraits'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create($acte_id)
    {
        $acte = $this->acteAcademiqueRepository->find($acte_id);
        if(empty($acte)){
            return back()->with('reponse', 'Acte non trouvé');
        }
        return view('backend.retrait_actes.create', compact('acte'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRetraitActeRequest $request, string $acte_id)
    {
        $acte = $this->acteAcademiqueRepository->find($acte_id);
        if(empty($acte)){
            return back()->with('reponse', 'Acte non trouvé');
        }

        $validated = $request->validated();
        $input = $request->all();
        $input_retrait = [];
        $input_retrait['acteAcademique_id'] = $acte->id;
        $input_retrait['user_id'] = Auth::user()->id;
        $input_retrait['dateRetrait'] = $input['dateRetrait'];
        $input_retrait['reference'] = $acte->reference.''.count($acte->retraits) +1;
        $input_retrait['retirant'] = $input['retirant'];
        
        $retrait = $this->modelRepository->create($input_retrait);

        $acte->statutRemise = true;
        $acte->update();
        return redirect(route('actes.provisoires.retrait'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $retrait = $this->modelRepository->find($id);

        if (empty($retrait)) {
            return redirect(route('retrait_actes.index'));
        }

        return view('backend.retrait_actes.show')->with('retrait', $retrait);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $retrait = $this->modelRepository->find($id);

        if (empty($retrait)) {
            return redirect(route('retrait_actes.index'));
        }

        return view('backend.retrait_actes.edit')->with('retrait', $retrait);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRetraitActeRequest $request, string $id)
    {
        $validated = $request->validated();
        $input = $request->all();
        $retrait = $this->modelRepository->find($id);

        if (empty($retrait)) {
            return redirect(route('retrait_actes.index'));
        }
        
        $retrait = $this->modelRepository->update($input, $id);
        return redirect(route('retrait_actes.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $retrait = $this->modelRepository->find($id);

        if (empty($retrait)) {
            $message = "Retrait acte introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "Retrait acte supprimé avec succès";
        return redirect(route('retrait_actes.index'));
    }

}
