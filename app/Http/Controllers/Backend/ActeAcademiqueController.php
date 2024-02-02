<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Repositories\ActeAcademiqueRepository;
use App\Http\Requests\StoreActeAcademiqueRequest;
use App\Http\Requests\UpdateActeAcademiqueRequest;
use App\Models\CategorieActe;
use App\Models\Etudiant;
use App\Models\ProcesVerbal;
use App\Repositories\CategorieActeRepository;
use App\Repositories\NumeroteurRepository;
use App\Repositories\ResultatAcademiqueRepository;
use App\Repositories\SignataireActeRepository;
use Illuminate\Support\Facades\Auth;

class ActeAcademiqueController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;
    private $categorieRepository;
    private $resultatRepository;
    private $signataireActeRepository;
    private $numeroteurRepository;

    public function __construct(ActeAcademiqueRepository $acteRepo, CategorieActeRepository $categorieRepo, ResultatAcademiqueRepository $resultatRepo, SignataireActeRepository $signataireActeRepo, NumeroteurRepository $numeroteurRepo)
    {
        $this->modelRepository = $acteRepo;
        $this->categorieRepository = $categorieRepo;
        $this->resultatRepository = $resultatRepo;
        $this->signataireActeRepository = $signataireActeRepo;
        $this->numeroteurRepository = $numeroteurRepo;
    }

    /**Etablir une seul attestation provisoire */
    public function provisoire1($resultat_id)
    {
        $resultat = $this->resultatRepository->find($resultat_id);
        $institution = $resultat->procesVerbal->parcours->filiere->institution;
        $etudiant = $resultat->inscription->etudiant;
        $categorieActe = $this->categorieRepository->findByIntitule('PROVISOIRE');

        $signataireActe = $this->signataireActeRepository->findByActiveInstitutionAndCategorieActe($institution->id, $categorieActe->id);
        $reponse = 'Aucun Signataire configuré';

        if (empty($signataireActe)) {
            return back()->with('reponse', $reponse);
        }

        $numeroteur = $this->numeroteurRepository->findByInstitutionandCategorie($institution->id, $categorieActe->id);
        $reponse = 'Aucun Numéroteur associé';

        if (empty($numeroteur)) {
            return back()->with('reponse', $reponse);
        }

        return view('backend.acte_academiques.create', compact('resultat', 'categorieActe', 'signataireActe', 'etudiant'));
    }

    /**Etablir plusieurs attestations  provisoires en un coup */
    public function provisoire2($procesVerbal_id)
    {
        $resultats = $this->resultatRepository->findByProcesVerbal($procesVerbal_id);

        $reponse = 'Aucun résultat académique associé à ce PV';

        if ($resultats->isEmpty()) {
            return back()->with('reponse', $reponse);
        }

        $categorieActe = $this->categorieRepository->findByIntitule('PROVISOIRE');

        $institution = $resultats->first()->procesVerbal->parcours->filiere->institution;

        $signataireActe = $this->signataireActeRepository->findByActiveInstitutionAndCategorieActe($institution->id, $categorieActe->id);

        $pv = ProcesVerbal::find($procesVerbal_id);

        return view('backend.acte_academiques.create2', compact('categorieActe', 'signataireActe', 'procesVerbal_id', 'pv'));
    }

    /**Etablir plusieurs attestations définitives en un coup */    
    public function definitive2($procesVerbal_id)
    {
        $resultats = $this->resultatRepository->findByProcesVerbal($procesVerbal_id);

        $categorieActeProvisoire = $this->categorieRepository->findByIntitule('PROVISOIRE');

        $categorieActe = $this->categorieRepository->findByIntitule('DEFINITIVE');

        $actesProvisoires = $this->modelRepository->findByPvCategorie($procesVerbal_id, $categorieActeProvisoire->id);

        $reponse = 'Aucun résultat académique associé à ce PV';

        if ($resultats->isEmpty()) {
            return back()->with('reponse', $reponse);
        }

        if ($actesProvisoires->isEmpty()) {
            $reponse = "Les actes provisoires du PV choisi n'ont pas encore été crées";
            return back()->with('reponse', $reponse);
        }

        $institution = $resultats->first()->procesVerbal->parcours->filiere->institution->parent;

        $signataireActe = $this->signataireActeRepository->findByActiveInstitutionAndCategorieActe($institution->id, $categorieActe->id);

        $pv = ProcesVerbal::find($procesVerbal_id);

        return view('backend.acte_academiques.create3', compact('categorieActe', 'signataireActe', 'procesVerbal_id', 'pv'));
    }

    /**Etablir une attestation définitive */
    public function definitive1($resultat_id)
    {
        
        $resultat = $this->resultatRepository->find($resultat_id);
        
        $categorieActeProvisoire = $this->categorieRepository->findByIntitule('PROVISOIRE');

        $categorieActe = $this->categorieRepository->findByIntitule('DEFINITIVE');

        $actesProvisoires = $resultat->getActe('PROVISOIRE');
        $reponse = 'Aucun résultat académique associé à cet étudiant pour le PV concerné !';

        if ($resultat == null) {
            return back()->with('reponse', $reponse);
        }

        if ($actesProvisoires == null) {
            $reponse = "L'acte provisoire de l'étudiant cible n'a pas encore été crée";
            return back()->with('reponse', $reponse);
        }

        $institution = $resultat->procesVerbal->parcours->filiere->institution->parent;

        $signataireActe = $this->signataireActeRepository->findByActiveInstitutionAndCategorieActe($institution->id, $categorieActe->id);
        if(empty($signataireActe)){
            return back()->with('reponse', "Aucun signataire configuré pour les ".$categorieActe->intitule);
        }
        $numeroteur = $this->numeroteurRepository->findByInstitutionAndCategorie($institution->id, $categorieActe->id);
        $reponse = 'Aucun Numéroteur associé';

        if (empty($numeroteur)) {
            return back()->with('reponse', $reponse);
        }
        $pv = $resultat->procesVerbal;

        $etudiant = $resultat->inscription->etudiant;
        
        return view('backend.acte_academiques.create_definitive', compact('categorieActe', 'signataireActe', 'pv', 'resultat', 'etudiant'));
    }

    /**Etablir un diplome */
    public function diplome($resultat_id)
    {
        $user = Auth::user();
        $resultat = $this->resultatRepository->find($resultat_id);
        $institution = $resultat->procesVerbal->parcours->filiere->institution->parent;
        $etudiant = $resultat->inscription->etudiant;
        $categorieActe = $this->categorieRepository->findByIntitule('DIPLOME');

        $signataireActe = $this->signataireActeRepository->findByActiveInstitutionAndCategorieActe($institution->id, $categorieActe->id);
        $reponse = 'Aucun Signataire configuré';

        if (empty($signataireActe)) {
            return back()->with('reponse', $reponse);
        }

        $numeroteur = $this->numeroteurRepository->findByInstitutionandCategorie($institution->id, $categorieActe->id);
        $reponse = 'Aucun Numéroteur associé';

        if (empty($numeroteur)) {
            return back()->with('reponse', $reponse);
        }

        return view('backend.acte_academiques.create_diplome', compact('resultat', 'categorieActe', 'signataireActe', 'etudiant'));
    
    }

    public function index()
    {
        $actes = $this->modelRepository->all();
        return view('backend.acte_academiques.index', compact('actes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $resultats = $this->resultatRepository->all();
        $categories = $this->categorieRepository->all();
        $signataireActes = $this->signataireActeRepository->all();

        return view('backend.acte_academiques.create', compact('resultats', 'categories', 'signataireActes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActeAcademiqueRequest $request)
    {
        $user = Auth::user();
        $validated = $request->validated();
        $input = $request->all();
        $resultat = $this->resultatRepository->find($input['resultat_id']);
        $institution = $resultat->procesVerbal->parcours->filiere->institution;
        $etudiant = $resultat->inscription->etudiant;
        $parcours = $resultat->inscription->parcours;
        $categorieActe = $this->categorieRepository->find($input['categorieActe_id']);
        $signataireActe = $this->signataireActeRepository->findByActiveInstitution($institution->id);

        $numeroteur = $this->numeroteurRepository->findByInstitutionandCategorie($institution->id, $categorieActe->id);

        $numeroteur->compteur += 1;
        $input_acte = [];
        $input_acte['reference'] = explode('-', $resultat->procesVerbal->anneeAcademique->intitule)[1] . '' . $categorieActe->id. ''.$etudiant->identifiant;
        $input_acte['numero'] = $numeroteur->compteur;
        $input_acte['dateSignature'] = $input['dateSignature'];
        $input_acte['statutSignaure'] = false;
        $input_acte['statutRemise'] = false;
        $input_acte['lieu'] = $input['lieu'];
        $input_acte['resultatAcademique_id'] = $resultat->id;
        $input_acte['signataireActe_id'] = $signataireActe->id;
        $input_acte['categorieActe_id'] = $categorieActe->id;
        $input_acte['intitule'] = strtoupper($categorieActe->intitule . ' de ' . $parcours->niveauEtude->intitule);
        $input_acte['user_id'] = $user->id;
        $numeroteur->update();

        $acte = $this->modelRepository->create($input_acte);

        return redirect(route('actes.provisoires.index'))->with('reponse', "Attestation provisoire créée avec succès");
    }

    public function store2(StoreActeAcademiqueRequest $request)
    {
        $resultats = $this->resultatRepository->findByProcesVerbal($request->procesVerbal_id);

        $validated = $request->validated();
        $input = $request->all();

        foreach ($resultats as $key => $resultat) {
            $institution = $resultat->procesVerbal->parcours->filiere->institution;
            $etudiant = $resultat->inscription->etudiant;
            $parcours = $resultat->inscription->parcours;
            $categorieActe = $this->categorieRepository->find($request->categorieActe_id);
            $signataireActe = $this->signataireActeRepository->findByActiveInstitutionAndCategorieActe($institution->id, $categorieActe->id);
            $numeroteur = $this->numeroteurRepository->findByInstitutionandCategorie($institution->id, $categorieActe->id);
            $numeroteur->compteur += 1;
            $input_acte = [];
            $input_acte['reference'] = explode('-', $resultat->procesVerbal->anneeAcademique->intitule)[1] . '' . $categorieActe->id. ''.$etudiant->identifiant;
            $resultat->procesVerbal->anneeAcademique->intitule . '_' . $etudiant->identifiant;
            $input_acte['numero'] = $numeroteur->compteur;
            $input_acte['dateSignature'] = $input['dateSignature'];
            $input_acte['statutSignaure'] = false;
            $input_acte['statutRemise'] = false;
            $input_acte['lieu'] = $input['lieu'];
            $input_acte['resultatAcademique_id'] = $resultat->id;
            $input_acte['signataireActe_id'] = $signataireActe->id;
            $input_acte['categorieActe_id'] = $categorieActe->id;
            $input_acte['intitule'] = strtoupper($categorieActe->intitule . ' de ' . $parcours->niveauEtude->intitule);
            $input_acte['user_id'] = Auth::user()->id;
            $numeroteur->update();

            $acte = $this->modelRepository->create($input_acte);
        }

        return redirect(route('actes.provisoires.index'))->with('reponse', "Attestation provisoire créée avec succès");
    }

    public function storeDefinitive(StoreActeAcademiqueRequest $request)
    {
        $user = Auth::user();
        
        $validated = $request->validated();
        $input = $request->all();
        $resultat = $this->resultatRepository->find($input['resultat_id']);        
        $institution = $resultat->procesVerbal->parcours->filiere->institution->parent;
        $etudiant = $resultat->inscription->etudiant;
        $parcours = $resultat->inscription->parcours;
        $categorieActe = $this->categorieRepository->find($request->categorieActe_id);
        $signataireActe = $this->signataireActeRepository->findByActiveInstitutionAndCategorieActe($institution->id, $categorieActe->id);
        $numeroteur = $this->numeroteurRepository->findByInstitutionandCategorie($institution->id, $categorieActe->id);
        $numeroteur->compteur += 1;
        $input_acte = [];
        $input_acte['reference'] = explode('-', $resultat->procesVerbal->anneeAcademique->intitule)[1] . '' . $categorieActe->id. ''.$etudiant->identifiant;
        $input_acte['numero'] = $numeroteur->compteur;
        $input_acte['dateSignature'] = $input['dateSignature'];
        $input_acte['statutSignaure'] = false;
        $input_acte['statutRemise'] = false;
        $input_acte['lieu'] = $input['lieu'];
        $input_acte['resultatAcademique_id'] = $resultat->id;
        $input_acte['signataireActe_id'] = $signataireActe->id;
        $input_acte['categorieActe_id'] = $categorieActe->id;
        $input_acte['intitule'] = strtoupper($categorieActe->intitule . ' de ' . $parcours->niveauEtude->intitule);
        $input_acte['user_id'] = $user->id;
        $numeroteur->update();

        $acte = $this->modelRepository->create($input_acte);
        return redirect(route('actes.definitives.index'))->with('reponse', "Attestation définitive créée avec succès");
    
    }


    public function storeDiplome(StoreActeAcademiqueRequest $request)
    {
        $user = Auth::user();
        
        $validated = $request->validated();
        $input = $request->all();
        $resultat = $this->resultatRepository->find($input['resultat_id']);        
        
        $institution = $resultat->procesVerbal->parcours->filiere->institution->parent;
        $etudiant = $resultat->inscription->etudiant;
        $parcours = $resultat->inscription->parcours;
        $categorieActe = $this->categorieRepository->find($request->categorieActe_id);
        $signataireActe = $this->signataireActeRepository->findByActiveInstitutionAndCategorieActe($institution->id, $categorieActe->id);
        $numeroteur = $this->numeroteurRepository->findByInstitutionAndCategorie($institution->id, $categorieActe->id);
        $numeroteur->compteur += 1;
        $input_acte = [];
        $input_acte['reference'] = explode('-', $resultat->procesVerbal->anneeAcademique->intitule)[1] . '' . $categorieActe->id. ''.$etudiant->identifiant;
        $input_acte['numero'] = $numeroteur->compteur;
        $input_acte['dateSignature'] = $input['dateSignature'];
        $input_acte['statutSignaure'] = false;
        $input_acte['statutRemise'] = false;
        $input_acte['lieu'] = $input['lieu'];
        $input_acte['resultatAcademique_id'] = $resultat->id;
        $input_acte['signataireActe_id'] = $signataireActe->id;
        $input_acte['categorieActe_id'] = $categorieActe->id;
        $input_acte['intitule'] = strtoupper($categorieActe->intitule);
        $input_acte['user_id'] = $user->id;
        $numeroteur->update();

        $acte = $this->modelRepository->create($input_acte);
        return redirect(route('actes.diplomes.index'))->with('reponse', "Diplôme créé avec succès");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $acte = $this->modelRepository->find($id);

        if (empty($acte)) {
            return redirect(route('acte_academiques.index'));
        }

        return view('backend.acte_academiques.show')->with('acte', $acte);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $acte = $this->modelRepository->find($id);

        if (empty($acte)) {
            return redirect(route('acte_academiques.index'));
        }

        return view('backend.acte_academiques.edit')->with('acte', $acte);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActeAcademiqueRequest $request, string $id)
    {
        $validated = $request->validated();
        $input = $request->all();
        $acte = $this->modelRepository->find($id);

        if (empty($acte)) {
            return redirect(route('acte_academiques.index'));
        }

        $acte = $this->modelRepository->update($input, $id);
        return redirect(route('acte_academiques.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $acte = $this->modelRepository->find($id);

        if (empty($acte)) {
            $message = 'Acte introuvable';
            return back()->with('reponse', $message);
        }

        $this->modelRepository->delete($id);

        $message = 'Acte supprimé avec succès';
        return back()->with('reponse', $message);
    }
}
