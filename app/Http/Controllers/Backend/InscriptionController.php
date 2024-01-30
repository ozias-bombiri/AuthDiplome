<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\InscriptionRepository;
use App\Http\Requests\StoreInscriptionRequest;
use App\Http\Requests\UpdateInscriptionRequest;
use App\Repositories\AnneeAcademiqueRepository;
use App\Repositories\EtudiantRepository;
use App\Repositories\ParcoursRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InscriptionController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;
    private $etudiantRepository;
    private $parcoursRepository;
    private $anneeAcademiqueRepository;

    public function __construct(
        InscriptionRepository $incriptionRepo, 
        EtudiantRepository $etudiantRepo,
        ParcoursRepository $parcoursRepo,
        AnneeAcademiqueRepository $anneRepo
        )
    {
        $this->modelRepository = $incriptionRepo;
        $this->etudiantRepository = $etudiantRepo;
        $this->parcoursRepository = $parcoursRepo;
        $this->anneeAcademiqueRepository = $anneRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        $parcours = $this->parcoursRepository->find($id);
        $inscriptions = $this->modelRepository->findByParcours($parcours->id);
        $annees = $this->anneeAcademiqueRepository->all();   
        
        if(isset($_GET['annee'])){
            $annee_id = $_GET['annee'];
            $inscriptions = $this->modelRepository->findByParcoursandAnnee($parcours->id, $annee_id);        
        }
        if ($request->ajax()) {
            $data = [];
            if(empty($inscriptions)){
                $data = "Nothing";
            }
            else {
            $data = [
                'parcours' => $parcours,
                'inscriptions' => $inscriptions,
                'annees' => $annees,
            ];
        }
            return response()->json(['result' =>$data]);
        }
        return view('backend.inscriptions.index', compact('parcours', 'inscriptions', 'annees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $parcours = $this->parcoursRepository->find($id);
        $annees = $this->anneeAcademiqueRepository->all();
        return view('backend.inscriptions.create', compact('annees', 'parcours')) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInscriptionRequest $request, $id)
    {
        $user = Auth::user();
        $parcours = $this->parcoursRepository->find($id);
        $input = $request->all();
        $input_etudiant =[];
        $input_etudiant['identifiant'] = $input['identifiant'];
        $input_etudiant['typeIdentifiant'] = $input['typeIdentifiant'];
        $input_etudiant['nom'] = $input['nom'];
        $input_etudiant['prenom'] = $input['prenom'];
        $input_etudiant['sexe'] = $input['sexe'];
        $input_etudiant['dateNaissance'] = $input['dateNaissance'];
        $input_etudiant['lieuNaissance'] = $input['lieuNaissance'];
        $input_etudiant['paysNaissance'] = $input['paysNaissance'];

        $input_etudiant['nevers'] = (isset($input['nevers'])) ? true : false ;
        $etudiant = $this->etudiantRepository->findByIdentifiant($input['identifiant']);
        if(empty($etudiant)){
            $etudiant = $this->etudiantRepository->create($input_etudiant);
        }
        $annee = $this->anneeAcademiqueRepository->find($input['anneeAcademique_id']);
        
        $input_inscription = [];
        $input_inscription['anneeAcademique_id'] = $annee->id;
        $input_inscription['referenceInscription'] = $annee->intitule.'-'.$etudiant->identifiant ;
        $input_inscription['parcours_id'] = $parcours->id;
        $input_inscription['etudiant_id'] = $etudiant->id;
        $input_inscription['user_id'] = $user->id;
        $inscription = $this->modelRepository->create($input_inscription);

        //Flash::success('resultat enregistré avec succès.');

        return redirect(route('parcours.inscriptions.index', $parcours->id));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $inscription = $this->modelRepository->find($id);

        if (empty($inscription)) {
            return back()->with("response", "Inscriptions non trouvée !") ;
            //return redirect(route('inscriptions.index'));
        }

        return view('backend.inscriptions.show')->with('inscription', $inscription);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $inscription = $this->modelRepository->find($id);

        if (empty($inscription)) {
            //Flash::error('resultat not found');

            return redirect(route('inscriptions.index'));
        }

        return view('backend.inscriptions.edit')->with('inscription', $inscription);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInscriptionRequest $request, string $id)
    {
        $inscription = $this->modelRepository->find($id);

        if (empty($inscription)) {
            //Flash::error('resultat not found');

            return redirect(route('inscriptions.index'));
        }

        $inscription = $this->modelRepository->update($request->all(), $id);

        //Flash::success('resultat modifié avec succès.');

        return redirect(route('inscriptions.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $inscription = $this->modelRepository->find($id);

        if (empty($inscription)) {
            $message = "Inscription introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "Inscription supprimée avec succès";
        return $this->sendSuccessDialogResponse($message);
    }
}
