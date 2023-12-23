<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Repositories\ActeAcademiqueRepository;
use App\Http\Requests\StoreActeAcademiqueRequest ;
use App\Http\Requests\UpdateActeAcademiqueRequest ;
use App\Models\CategorieActe;
use App\Repositories\CategorieActeRepository;
use App\Repositories\NumeroteurRepository;
use App\Repositories\ResultatAcademiqueRepository;
use App\Repositories\SignataireActeRepository;




class ActeAcademiqueController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;
    private $categorieRepository;
    private $resultatRepository;
    private $signataireActeRepository;
    private $numeroteurRepository;

    public function __construct(
            ActeAcademiqueRepository $acteRepo, 
            CategorieActeRepository $categorieRepo,
            ResultatAcademiqueRepository $resultatRepo,
            SignataireActeRepository $signataireActeRepo,
            NumeroteurRepository $numeroteurRepo
            ) 
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
        $categorieActe = $this->categorieRepository->findByIntitule("PROVISOIRE");
        $signataireActe = $this->signataireActeRepository->findByActiveInstitution($institution->id); 
        
        return view('backend.acte_academiques.create', compact('resultat','categorieActe', 'signataireActe', 'etudiant'));
    }

    /**Etablir plusieurs attestations en un coup */
    public function provisoire2($procesVerbal_id)
    {
        $resultats = $this->resultatRepository->findByProcesVerbal($procesVerbal_id);
        $categorieActe = $this->categorieRepository->findByIntitule("PROVISOIRE");
        
        return view('backend.acte_academiques.create2', compact('resultat','categorieActe', 'signataireActe', 'etudiant'));
    
    }

    /**Etablir une attestation définitive */
    public function definitive($resultat_id)
    {
        $resultat = $this->resultatRepository->find($resultat_id);
        $institution = $resultat->procesVerbal->parcours->filiere->institution;
        $etudiant = $resultat->inscription->etudiant;
        $categorieActe = $this->categorieRepository->findByIntitule("DEFINITIVE");
        $signataireActe = $this->signataireActeRepository->findByActiveInstitution($institution->id); 
        
        return view('backend.acte_academiques.create', compact('resultat','categorieActe', 'signataireActe', 'etudiant'));
    
    }

    /**Etablir un diplome */
    public function diplome($resultat_id)
    {
        $resultat = $this->resultatRepository->find($resultat_id);
        $institution = $resultat->procesVerbal->parcours->filiere->institution;
        $etudiant = $resultat->inscription->etudiant;
        $categorieActe = $this->categorieRepository->findByIntitule("DIPLOME");
        $signataireActe = $this->signataireActeRepository->findByActiveInstitution($institution->id); 
        
        return view('backend.acte_academiques.create', compact('resultat','categorieActe', 'signataireActe', 'etudiant'));
    
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

        return view('backend.acte_academiques.create', compact('resultats','categories','signataireActes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActeAcademiqueRequest $request)
    {

        $validated = $request->validated();
        $input = $request->all();
        $resultat = $this->resultatRepository->find($input['resultat_id']);
        $institution = $resultat->procesVerbal->parcours->filiere->institution;
        $etudiant = $resultat->inscription->etudiant;
        $parcours = $resultat->inscription->parcours;
        $categorieActe = $this->categorieRepository->find($input['categorieActe_id']);
        $signataireActe = $this->signataireActeRepository->findByActiveInstitution($institution->id);
        
        $numeroteur = $this->numeroteurRepository->findByInstitutionandCategorie($institution->id, $categorieActe->id);
        $numeroteur->compteur +=1;
        $input_acte = [];
        $input_acte['reference'] = $resultat->procesVerbal->anneeAcademique->intitule.'_'.$etudiant->identifiant;
        $input_acte['numero'] = $numeroteur->compteur;
        $input_acte['dateSignature'] = $input['dateSignature'];
        $input_acte['statutSignaure'] = false;
        $input_acte['statutRemise'] = false;
        $input_acte['lieu'] = $input['lieu'];
        $input_acte['resultatAcademique_id'] = $resultat->id;
        $input_acte['signataireActe_id'] = $signataireActe->id;
        $input_acte['categorieActe_id'] = $categorieActe->id;
        $input_acte['intitule'] = strtoupper($categorieActe->intitule.' de '.$parcours->niveauEtude->intitule);
        $input_acte['user_id'] = 1;
        $numeroteur->update();
        
        $acte = $this->modelRepository->create($input_acte);

        return redirect(route('acte_academiques.index'));
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
            $message = "Acte introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "Acte supprimé avec succès";
        return redirect(route('acte_academiques.index'));
    }

}
