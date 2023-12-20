<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Repositories\ActeAcademiqueRepository;
use App\Http\Requests\StoreActeAcademiqueRequest ;
use App\Http\Requests\UpdateActeAcademiqueRequest ;
use App\Repositories\CategorieActeRepository;
use App\Repositories\ResultatAcademiqueRepository;
use App\Repositories\SignataireActeRepository;




class ActeAcademiqueController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;
    private $categorieRepository;
    private $resultatRepository;
    private $signataireActeRepository;

    public function __construct(
            ActeAcademiqueRepository $acteRepo, 
            CategorieActeRepository $categorieRepo,
            ResultatAcademiqueRepository $resultatRepo,
            SignataireActeRepository $signataireActeRepo
            ) 
    {
        $this->modelRepository = $acteRepo;
        $this->categorieRepository = $categorieRepo;
        $this->resultatRepository = $resultatRepo;
        $this->signataireActeRepository = $signataireActeRepo;
    }

    public function index()
    {
        //$actes = $this->modelRepository->all();
        return view('backend.acte_academiques.index');
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

        $acte = $this->modelRepository->create($input);

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
