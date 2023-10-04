<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\TimbreRepository;
use App\Http\Requests\StoreTimbreRequest;
use App\Http\Requests\UpdateTimbreRequest;
use App\Repositories\InstitutionRepository;

class TimbreController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;
    private $institutionRepository;

    public function __construct(TimbreRepository $timbreRepo, InstitutionRepository $institutionRepo)
    {
        $this->modelRepository = $timbreRepo;
        $this->institutionRepository = $institutionRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.timbres.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $institutions = $this->institutionRepository->all();
        return view('backend.timbres.create', compact('institutions')) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTimbreRequest $request)
    {
        $input = $request->all();

        $timbre = $this->modelRepository->create($input);

        //Flash::success('timbre enregistré avec succès.');

        return redirect(route('timbres.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $timbre = $this->modelRepository->find($id);

        if (empty($timbre)) {
            //Flash::error('timbre not found');

            return redirect(route('timbres.index'));
        }

        return view('backend.timbres.show')->with('timbre', $timbre);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $timbre = $this->modelRepository->find($id);

        if (empty($timbre)) {
            //Flash::error('timbre not found');

            return redirect(route('timbres.index'));
        }

        return view('backend.timbres.edit')->with('timbre', $timbre);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTimbreRequest $request, string $id)
    {
        $timbre = $this->modelRepository->find($id);

        if (empty($timbre)) {
            //Flash::error('timbre not found');

            return redirect(route('timbres.index'));
        }

        $timbre = $this->modelRepository->update($request->all(), $id);

        //Flash::success('timbre modifié avec succès.');

        return redirect(route('timbres.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $timbre = $this->modelRepository->find($id);

        if (empty($timbre)) {
            $message = "timbre introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "timbre supprimé avec succès";
        return $this->sendSuccessDialogResponse($message);
    }
}