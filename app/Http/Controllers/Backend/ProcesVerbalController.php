<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ProcesVerbalRepository;
use App\http\Requests\StoreProcesVerbalRequest ;
use App\http\Requests\UpdateProcesVerbalRequest ;
use App\Repositories\AnneeAcademiqueRepository;
use App\Repositories\ParcoursRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Repositories\NiveauEtudeRepository;

class ProcesVerbalController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;
    private $parcoursRepository;
    private $anneeAcademiqueRepository;
    private $niveauRepository;

    public function __construct(
        ProcesVerbalRepository $procesRepo,
        ParcoursRepository $parcoursRepo,
        AnneeAcademiqueRepository $anneeAcademiqueRepo,
        NiveauEtudeRepository $niveauRepo
        )
    {
        $this->modelRepository = $procesRepo;
        $this->parcoursRepository = $parcoursRepo;
        $this->anneeAcademiqueRepository = $anneeAcademiqueRepo;
        $this->niveauRepository = $niveauRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $institution = Auth::user()->institution;        
        $proces_verbals = [];
        $annee_id = null;
        if(isset($_GET['annee'])){
            $annee_id = $_GET['annee'];                            
        }        
        
        if(!empty($institution)){
            if($institution->type === "IESR"){
                if($annee_id!=null){
                    $proces_verbals = $this->modelRepository->findByIesrAndAnnee($institution->id, $annee_id);                    
                }
                else {
                    $proces_verbals = $this->modelRepository->findByIesr($institution->id);
                }
                 
            }
            else{
                if($annee_id!=null){
                    $proces_verbals = $this->modelRepository->findByEtablissementAndAnnee($institution->id, $annee_id);                    
                }
                else {
                    $proces_verbals = $this->modelRepository->findByEtablissement($institution->id);
                }
            }
        }
        
        else {
            if($annee_id!=null){
                $proces_verbals = $this->modelRepository->findByAnnee($annee_id);                    
            }
            else {
                $proces_verbals = $this->modelRepository->all();
            }
            
        }
        $annees = $this->anneeAcademiqueRepository->all();        
        return view('backend.proces_verbals.index', compact('proces_verbals', 'annees'));
        
    }

    /**
     * Display a listing of the resource for a given parcours.
     */
    public function index2($parcours_id)
    {
        $parcours = $this->parcoursRepository->find($parcours_id);        
        
        $proces_verbals = $this->modelRepository->findByParcours($parcours->id);
        $annees = $this->anneeAcademiqueRepository->all();        
        return view('backend.proces_verbals.index', compact('proces_verbals', 'parcours', 'annees'));
        
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $institution = Auth::user()->institution;        
        $anneeAcademiques = $this->anneeAcademiqueRepository->all();
        $parcour = null;
        $parcours = null;
        if(isset($_GET['parcours_id'])){
            $parcour = $this->parcoursRepository->find($_GET['parcours_id']);                  
        }
        if(!empty($parcour)) {
            
            return view('backend.proces_verbals.create', compact('parcour','anneeAcademiques'));
        }
        else {
            if(!empty($institution)){
                $parcours = $this->parcoursRepository->findByInstitution($institution->id); 
                          
            }
            else {
                $parcours = $this->parcoursRepository->all();
            
            }
            //dd($parcours); 
            return view('backend.proces_verbals.create', compact('parcours','anneeAcademiques'));
    
        }

        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = Auth::id(); 
        $input = $request->all();
        $input['user_id'] = $user_id;
        $parcours = $this->parcoursRepository->find($input['parcours_id']);
        $annee = $this->anneeAcademiqueRepository->find($input['anneeAcademique_id']);
        $input['reference'] = "PV_".$parcours->id.'-'.$annee->id;
        $input['intitule'] = strtoupper("PV_".$parcours->intitule.'-'.$annee->intitule.' Session : '.$input['session']);
        if($parcours->soutenance) $input['type'] = "SOUTENANCE";
        else $input['type'] = "EXAMEN";
        
        if($request->file()) {
            $file = $request->file('nomFichierPdf');
            $fileName = 'PV_du'.str_replace(array('/', '%', '@', '\'', ';', '<', '>' ), '_', $input['reference']).'_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/PDFs'), $fileName);
            $input['nomFichierPdf'] = $fileName;
        }
        
        $proces_verbal = $this->modelRepository->create($input);

        return redirect(route('proces_verbals.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $proces_verbal = $this->modelRepository->find($id);

        if (empty($proces_verbal)) {
            return redirect(route('proces_verbals.index'));
        }

        return view('backend.proces_verbals.show')->with('proces_verbal', $proces_verbal);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $proces_verbal = $this->modelRepository->find($id);

        if (empty($proces_verbal)) {
            return redirect(route('proces_verbals.index'));
        }

        return view('backend.proces_verbals.edit')->with('proces_verbal', $proces_verbal);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProcesVerbalRequest $request, string $id)
    {
        $proces_verbal = $this->modelRepository->find($id);

        if (empty($proces_verbal)) {
            return redirect(route('proces_verbals.index'));
        }

        $proces_verbal = $this->modelRepository->update($request->all(), $id);
        return redirect(route('proces_verbals.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proces_verbal = $this->modelRepository->find($id);

        if (empty($proces_verbal)) {
            $reponse = "Procès verbal introuvable";
            return back()->with('reponse', $reponse);
        }

        $this->modelRepository->delete($id);

        $message = "Procès verbal supprimé avec succès";
        return $this->sendSuccessDialogResponse($message);
    }
}
