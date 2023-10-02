<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\DemandeAuthentificationRepository;
use App\http\Requests\StoreDemandeAuthentificationRequest ;
use App\http\Requests\UpdateDemandeAuthentificationRequest ;


class DemandeAuthentificationController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;

    public function __construct(DemandeAuthentificationRepository $demandeRepo)
    {
        $this->modelRepository = $demandeRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.demande_authentifications.index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.demande_authentifications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDemandeAuthentificationRequest $request)
    {
        $input = $request->all();

        $demande = $this->modelRepository->create($input);

        return redirect(route('demande_authentifications.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $demande = $this->modelRepository->find($id);

        if (empty($demande)) {
            return redirect(route('demande_authentifications.index'));
        }

        return view('backend.demande_authentifications.show')->with('demande', $demande);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $demande = $this->modelRepository->find($id);

        if (empty($demande)) {
            return redirect(route('demande_authentifications.index'));
        }

        return view('backend.demande_authentifications.edit')->with('demande', $demande);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDemandeAuthentificationRequest $request, string $id)
    {
        $demande = $this->modelRepository->find($id);

        if (empty($demande)) {
            return redirect(route('demande_authentifications.index'));
        }

        $demande = $this->modelRepository->update($request->all(), $id);
        return redirect(route('demande_authentifications.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $demande = $this->modelRepository->find($id);

        if (empty($demande)) {
            $message = "Demande introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "Demande supprimé avec succès";
        return $this->sendSuccessDialogResponse($message);
    }
}
