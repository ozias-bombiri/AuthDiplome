<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\ParcoursDataTable;
use App\Repositories\ParcoursRepository;
use App\Http\Requests\StoreParcoursRequest;
use App\Http\Requests\UpdateParcoursRequest;

class ParcoursController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;

    public function __construct(ParcoursRepository $parcoursRepo)
    {
        $this->modelRepository = $parcoursRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(ParcoursDataTable $dataTable)
    {
        return $dataTable->render('backend.parcours.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.parcours.create') ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreParcoursRequest $request)
    {
        $input = $request->all();

        $parcours = $this->modelRepository->create($input);

        //Flash::success('parcours enregistré avec succès.');

        return redirect(route('parcours.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $parcours = $this->modelRepository->find($id);

        if (empty($parcours)) {
            //Flash::error('parcours not found');

            return redirect(route('parcours.index'));
        }

        return view('backend.parcours.show')->with('parcours', $parcours);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $parcours = $this->modelRepository->find($id);

        if (empty($parcours)) {
            //Flash::error('parcours not found');

            return redirect(route('parcours.index'));
        }

        return view('backend.parcours.edit')->with('parcours', $parcours);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParcoursRequest $request, string $id)
    {
        $parcours = $this->modelRepository->find($id);

        if (empty($parcours)) {
            //Flash::error('parcours not found');

            return redirect(route('parcours.index'));
        }

        $parcours = $this->modelRepository->update($request->all(), $id);

        //Flash::success('parcours modifié avec succès.');

        return redirect(route('parcours.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $parcours = $this->modelRepository->find($id);

        if (empty($parcours)) {
            $message = "parcours introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "parcours supprimé avec succès";
        return $this->sendSuccessDialogResponse($message);
    }
}
