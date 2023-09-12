<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\TimbreIesrDataTable;
use App\Repositories\TimbreIesrRepository;
use App\Http\Requests\StoreTimbreIesrRequest;
use App\Http\Requests\UpdateTimbreIesrRequest;

class TimbreIesrController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;

    public function __construct(TimbreIesrRepository $timbreRepo)
    {
        $this->modelRepository = $timbreRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(TimbreIesrDataTable $dataTable)
    {
        return $dataTable->render('backend.timbre_iesrs.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.timbre_iesrs.create') ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTimbreIesrRequest $request)
    {
        $input = $request->all();

        $timbre = $this->modelRepository->create($input);

        //Flash::success('timbre enregistré avec succès.');

        return redirect(route('timbre_iesrs.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $timbre = $this->modelRepository->find($id);

        if (empty($timbre)) {
            //Flash::error('timbre not found');

            return redirect(route('timbre_iesrs.index'));
        }

        return view('backend.timbre_iesrs.show')->with('timbre', $timbre);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $timbre = $this->modelRepository->find($id);

        if (empty($timbre)) {
            //Flash::error('timbre not found');

            return redirect(route('timbre_iesrs.index'));
        }

        return view('backend.timbre_iesrs.edit')->with('timbre', $timbre);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTimbreIesrRequest $request, string $id)
    {
        $timbre = $this->modelRepository->find($id);

        if (empty($timbre)) {
            //Flash::error('timbre not found');

            return redirect(route('timbre_iesrs.index'));
        }

        $timbre = $this->modelRepository->update($request->all(), $id);

        //Flash::success('timbre modifié avec succès.');

        return redirect(route('timbre_iesrs.index'));
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
