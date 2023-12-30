<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Repositories\SignataireActeRepository;
use App\Http\Requests\StoreSignataireActeRequest ;
use App\Http\Requests\UpdateSignataireActeRequest ;
use App\Repositories\CategorieActeRepository;
use App\Repositories\SignataireRepository;
use App\Repositories\InstitutionRepository;
use Illuminate\Support\Facades\Auth;

class SignataireActeController extends Controller
{
    /** @var  modelRepository */ 
    private $modelRepository;
    private $categorieRepository;
    private $signataireRepository;
    private $institutionRepository;

    public function __construct(
        SignataireActeRepository $signActeRepo,
        CategorieActeRepository $categorieRepo,
        SignataireRepository $signataireRepo,
        InstitutionRepository $institutionRepo
        )
    {
        $this->modelRepository = $signActeRepo;
        $this->categorieRepository = $categorieRepo;
        $this->signataireRepository = $signataireRepo;
        $this->institutionRepository = $institutionRepo;
    }

    public function index()
    {
        $signataireActes = null;
        $institution = Auth::user()->institution;
        if(!empty($institution)){
            if($institution->type === "IESR"){
                $signataireActes = $this->modelRepository->findByIesr($institution->id); 
            }
            else{
                $signataireActes = $this->modelRepository->findByEtablissement($institution->id);            
            }
        }
        
        else {
            $signataireActes = $this->modelRepository->all();
        
        }
        return view('backend.signataire_actes.index', compact(('signataireActes')));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create1()
    {
        $categorie = $this->categorieRepository->findByIntitule('PROVISOIRE');
        $institution = Auth::user()->institution;
        $etablissements = null;
        $etablissement =null;
        if(!empty($institution)){
            if($institution->type === "IESR"){
                $etablissements = $institution->etablissements; 
            }
            else{
                $etablissement = $institution;
            }
        }
        
        else {
            $etablissements = $this->institutionRepository->findEtablissement();        
        }
        if($etablissements == null){
            return view('backend.signataire_actes.create', compact('categorie','etablissement'));
        }
        else {
            return view('backend.signataire_actes.create', compact('categorie','etablissements'));
        }        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create2()
    {

        $categories = $this->categorieRepository->all();        
        unset($categories[0]);
        $institution = Auth::user()->institution;
        $iesrs = null;
        $iesr =null;
        if(!empty($institution)){
            if($institution->type === "IESR"){
                $iesr = $institution; 
            }
            else {
                return back()->with('reponse', 'Opération non permise !');
            }
        }
        
        else {
            $iesrs = $this->institutionRepository->findByType('IESR');        
        }
        if($iesrs == null){
            return view('backend.signataire_actes.create2', compact('categories','iesr'));
        }
        else {
            return view('backend.signataire_actes.create2', compact('categories','iesrs'));
        }
        //return view('backend.signataire_actes.create2', compact('categories','signataires','institutions'));
    }

    /** 
     * Store a newly created resource in storage.
     */
    public function store1(StoreSignataireActeRequest $request)
    {
        $validated = $request->validated();
        $input = $request->all();

        $signataire = $this->signataireRepository->create($input);
        $signataireActe = [];
        $signataireActe['statut']  = true;
        $signataireActe['debut']  = $input['debut'];
        $signataireActe['fonction']  = $input['fonction'];
        $signataireActe['mention']  = $input['mention'];
        $signataireActe['categorieActe_id']  = $input['categorieActe_id'];
        $signataireActe['institution_id']  = $input['institution_id'];
        $signataireActe['signataire_id']  = $signataire->id;
        $existants = $this->modelRepository->findByInstitutionandCategorie($input['institution_id'], $input['categorieActe_id']);
        foreach($existants as $existant) {
            $existant->statut = false;
            $existant->update();
        }
        
        $sign_acte = $this->modelRepository->create($signataireActe);

        return redirect(route('signataire_actes.index'));
    }

    /** 
     * Store a newly created resource in storage.
     */
    public function store2(StoreSignataireActeRequest $request)
    {
        $validated = $request->validated();
        $input = $request->all();

        $sign_acte = $this->modelRepository->create($input);

        return redirect(route('signataire_actes.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sign_acte = $this->modelRepository->find($id);

        if (empty($sign_acte)) {
            return back()-with("response", "Signataire introuvable");
        }

        return view('backend.signataire_actes.show')->with('sign_acte', $sign_acte);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sign_acte = $this->modelRepository->find($id);

        if (empty($sign_acte)) {
            return back()->with("response", "Signataire non trouvé !");
        }

        return view('backend.signataire_actes.edit')->with('sign_acte', $sign_acte);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSignataireActeRequest $request, string $id)
    {
        $validated = $request->validated();
        $input = $request->all();
        $sign_acte = $this->modelRepository->find($id);

        if (empty($sign_acte)) {
            return back()->with("response", "Signataire non trouvé !");
        }
        $signataire = $this->signataireRepository->update($input,$input['signataire_id']);
        $signataireActe = [];
        $signataireActe['statut']  = (isset($input['statut'])) ? true : false ;
        $signataireActe['debut']  = $input['debut'];
        $signataireActe['fonction']  = $input['fonction'];
        $signataireActe['mention']  = $input['mention'];
        $signataireActe['categorieActe_id']  = $input['categorieActe_id'];
        $signataireActe['institution_id']  = $input['institution_id'];
        $signataireActe['signataire_id']  = $signataire->id;
        $existants = $this->modelRepository->findByInstitutionAndCategorie($input['institution_id'], $input['categorieActe_id']);
        if($signataireActe['statut']){
            foreach($existants as $existant) {
                $existant->statut = false;
                $existant->update();
            }
        }
        
        $sign_acte = $this->modelRepository->update($signataireActe, $input['signataireActe_id']);

        
        $sign_acte = $this->modelRepository->update($input, $id);
        return redirect(route('signataire_actes.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sign_acte = $this->modelRepository->find($id);

        if (empty($sign_acte)) {
            $message = "Signataire acte introuvable";
            return back()->with("response", $message);
        }

        $this->modelRepository->delete($id);

        $message = "Signataire acte supprimé avec succès";
        return redirect(route('signataire_actes.index', compact("message")));
    }

}
