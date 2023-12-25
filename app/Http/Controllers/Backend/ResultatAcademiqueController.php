<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\ResultatAcademiqueRepository;
use App\Http\Requests\StoreResultatAcademiqueRequest;
use App\Http\Requests\UpdateResultatAcademiqueRequest;
use App\Models\ResultatAcademique;
use App\Repositories\AnneeAcademiqueRepository;
use App\Repositories\EtudiantRepository;
use App\Repositories\InscriptionRepository;
use App\Repositories\ParcoursRepository;
use App\Repositories\ProcesVerbalRepository;
use Illuminate\Http\Request;

class ResultatAcademiqueController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;
    private $etudiantRepository;
    private $procesVervalRepository;
    private $anneeAcademiqueRepository;
    private $inscriptionRepository;

    public function __construct(
                ResultatAcademiqueRepository $resultatAcademiqueRepo, 
                EtudiantRepository $etudiantRepo,
                ProcesVerbalRepository $porcesVerbalRepo,
                AnneeAcademiqueRepository $anneeAcademiqueRepo,
                InscriptionRepository $inscriptionRepo
                )
    {
        $this->modelRepository = $resultatAcademiqueRepo;
        $this->etudiantRepository = $etudiantRepo;
        $this->procesVervalRepository = $porcesVerbalRepo;
        $this->anneeAcademiqueRepository = $anneeAcademiqueRepo;
        $this->inscriptionRepository = $inscriptionRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $procesVerbal = $this->procesVervalRepository->find($id);
        $resultats = $this->modelRepository->findByProcesVerbal($procesVerbal->id);
        return view('backend.resultat_academiques.index', compact('procesVerbal', 'resultats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $procesVerbal = $this->procesVervalRepository->find($id);
        $inscriptions = $this->inscriptionRepository->findByParcours($procesVerbal->parcours->id);
        $anneeAcademiques = $this->anneeAcademiqueRepository->all();
        return view('backend.resultat_academiques.create', compact('inscriptions', 'procesVerbal', 'anneeAcademiques')) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create2($id)
    {
        $procesVerbal = $this->procesVervalRepository->find($id);
        $inscriptions = $this->inscriptionRepository->findByParcours($procesVerbal->parcours->id);
        $anneeAcademiques = $this->anneeAcademiqueRepository->all();
        return view('backend.resultat_academiques.create2', compact('inscriptions', 'procesVerbal', 'anneeAcademiques')) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResultatAcademiqueRequest $request, $id)
    {
        $procesVerbal = $this->procesVervalRepository->find($id);        
        $input = $request->all();

        $input_resultat = [];
        $input_resultat['inscription_id'] = $input['inscription_id'];
        $input_resultat['procesVerbal_id'] = $procesVerbal->id;
        $input_resultat['moyenne'] = $input['moyenne'];
        $input_resultat['reference'] = $input['inscription_id'].''.$procesVerbal->id;
        $input_resultat['user_id'] = 1;
        $resultat = $this->modelRepository->create($input_resultat);

        
        return redirect(route('proces_verbaux.resultats.index', $procesVerbal->id));
    }

    public function store2(Request $request, $id)
    {
        $procesVerbal = $this->procesVervalRepository->find($id);  
        $inscriptions = $this->inscriptionRepository->findByParcours($procesVerbal->parcours->id);      

        $moyenne = $request->input('moyenne');

        foreach ($inscriptions as $i => $inscription){
            $data = array(
                'inscription_id' => $inscription->id,
                'procesVerbal_id' => $id,
                'moyenne' => $moyenne[$inscription->id],
                'reference' => $inscription->id.''.$id,
                'user_id' => 1
            );

            $resul = ResultatAcademique::where('inscription_id',$inscription->id)
                ->where('procesVerbal_id',$id)
                ->get()->first();

            if ($resul != null){
                ResultatAcademique::where('id',$resul->id)->update($data);
            }else{
                if($moyenne[$inscription->id] != null){
                    ResultatAcademique::create($data);
                }    
            }
        }
        
        return redirect(route('proces_verbaux.resultats.index', $id));
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $resultat = $this->modelRepository->find($id);

        if (empty($resultat)) {
            //Flash::error('resultat not found');

            return redirect(route('resultat_academiques.index'));
        }

        return view('backend.resultat_academiques.show')->with('resultat', $resultat);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $resultat = $this->modelRepository->find($id);

        if (empty($resultat)) {
            //Flash::error('resultat not found');

            return redirect(route('resultat_academiques.index'));
        }

        return view('backend.resultat_academiques.edit')->with('resultat', $resultat);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResultatAcademiqueRequest $request, string $id)
    {
        $resultat = $this->modelRepository->find($id);

        if (empty($resultat)) {
            //Flash::error('resultat not found');

            return redirect(route('resultat_academiques.index'));
        }

        $resultat = $this->modelRepository->update($request->all(), $id);

        //Flash::success('resultat modifié avec succès.');

        return redirect(route('resultat_academiques.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resultat = $this->modelRepository->find($id);

        if (empty($resultat)) {
            $message = "resultat introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "resultat supprimé avec succès";
        return $this->sendSuccessDialogResponse($message);
    }
}
