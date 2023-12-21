<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\InscriptionRepository;
use App\Http\Requests\StoreInscriptionRequest;
use App\Http\Requests\UpdateInscriptionRequest;
use App\Repositories\EtudiantRepository;
use App\Repositories\ParcoursRepository;

class InscriptionController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;
    private $etudiantRepository;
    private $parcoursRepository;

    public function __construct(
        InscriptionRepository $incriptionRepo, 
        EtudiantRepository $etudiantRepo,
        ParcoursRepository $parcoursRepo,
        )
    {
        $this->modelRepository = $incriptionRepo;
        $this->etudiantRepository = $etudiantRepo;
        $this->parcoursRepository = $parcoursRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inscriptions = $this->modelRepository->all();
        return view('backend.inscriptions.index', compact('inscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $etudiants = $this->etudiantRepository->all();
        $parcours = $this->parcoursRepository->all();
        return view('backend.inscriptions.create', compact('etudiants', 'parcours')) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInscriptionRequest $request)
    {
        $input = $request->all();

        $inscription = $this->modelRepository->create($input);

        //Flash::success('resultat enregistré avec succès.');

        return redirect(route('inscriptions.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $inscription = $this->modelRepository->find($id);

        if (empty($inscription)) {
            //Flash::error('resultat not found');

            return redirect(route('inscriptions.index'));
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
