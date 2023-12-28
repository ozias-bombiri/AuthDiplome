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


class ProcesVerbalController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;
    private $parcoursRepository;
    private $anneeAcademiqueRepository;

    public function __construct(
        ProcesVerbalRepository $procesRepo,
        ParcoursRepository $parcoursRepo,
        AnneeAcademiqueRepository $anneeAcademiqueRepo
        )
    {
        $this->modelRepository = $procesRepo;
        $this->parcoursRepository = $parcoursRepo;
        $this->anneeAcademiqueRepository = $anneeAcademiqueRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proces_verbals = [];
        
        if(isset($_GET['etablissement_id'])){
            $institution_id = $_GET['etablissement_id'];
            $proces_verbals = $this->modelRepository->findByInstitution($institution_id);
        
        }
        else if(isset($_GET['iesr_id'])){
            $institution_id = $_GET['iesr_id'];
            $proces_verbals = $this->modelRepository->findByIesr($institution_id);
        }
        else{
            $proces_verbals = $this->modelRepository->all();
        }
        $proces_verbals = $this->modelRepository->all();
        return view('backend.proces_verbals.index', compact('proces_verbals'));
        
    }

    /**
     * Display a listing of the resource for a given parcours.
     */
    public function index2($id)
    {
        $parcours = $this->parcoursRepository->find($id);
        $proces_verbals = $this->modelRepository->findByParcours($parcours->id);
        return view('backend.proces_verbals.index', compact('proces_verbals', 'parcours'));
        
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create($parcours_id)
    {
        $parcours = $this->parcoursRepository->find($parcours_id);
        if(empty($parcours)) {
            $reponse = "Parcours non trouvé !";
            return back()->with('reponse', $reponse);
        }

        $anneeAcademiques = $this->anneeAcademiqueRepository->all();
        return view('backend.proces_verbals.create', compact('parcours','anneeAcademiques'));
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
