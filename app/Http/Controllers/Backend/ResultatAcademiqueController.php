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
    private $procesVerbalRepository;
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
        $this->procesVerbalRepository = $porcesVerbalRepo;
        $this->anneeAcademiqueRepository = $anneeAcademiqueRepo;
        $this->inscriptionRepository = $inscriptionRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index($procesVerbal_id)
    {
        $procesVerbal = $this->procesVerbalRepository->find($procesVerbal_id);
        $resultats = $this->modelRepository->findByProcesVerbal($procesVerbal->id);
        return view('backend.resultat_academiques.index', compact('procesVerbal', 'resultats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $procesVerbal = $this->procesVerbalRepository->find($id);
        $anneeAcademiques = $this->anneeAcademiqueRepository->all();
        $inscriptions = $this->procesVerbalRepository->findByNoResultats($procesVerbal->id);
        
        $reponse = "Aucune inscription à ce parcours ou tout déja saisie" ;        
        if (count($inscriptions) < 1) return back()->with('reponse', $reponse);

        return view('backend.resultat_academiques.create', compact('inscriptions', 'procesVerbal', 'anneeAcademiques')) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create2($id)
    {
        $procesVerbal = $this->procesVerbalRepository->find($id);
        $anneeAcademiques = $this->anneeAcademiqueRepository->all();
        $inscriptions = $this->procesVerbalRepository->findByNoResultats($procesVerbal->id);
        
        $reponse = "Aucune inscription à ce parcours ou tout déja saisie" ;        
        if (count($inscriptions) < 1) return back()->with('reponse', $reponse);

        $reponse = "Aucune inscription à ce parcours" ;
        if (count($inscriptions) < 1) return back()->with('reponse', $reponse);

        return view('backend.resultat_academiques.create2', compact('inscriptions', 'procesVerbal', 'anneeAcademiques')) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResultatAcademiqueRequest $request, $id)
    {
        $procesVerbal = $this->procesVerbalRepository->find($id);        
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
        $procesVerbal = $this->procesVerbalRepository->find($id);  
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
    public function edit(string $pv_id, string $res_id)
    {
        $resultat = $this->modelRepository->find($res_id);

        if (empty($resultat)) {
            return back()->with('reponse', 'Résultat non trouvé !');
        }

        return view('backend.resultat_academiques.edit')->with('resultat', $resultat);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResultatAcademiqueRequest $request, string $pv_id, string $res_id)
    {
        $resultat = $this->modelRepository->find($res_id);

        if (empty($resultat)) {
            //Flash::error('resultat not found');

            return back()->with('reponse', 'Résultat non trouvé !');
        }

        $resultat = $this->modelRepository->update($request->all(), $res_id);
        return redirect(route('proces_verbaux.resultats.index', $resultat->procesVerbal->id));
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
