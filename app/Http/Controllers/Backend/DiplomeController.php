<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\DiplomeRepository;
use App\http\Requests\StoreDiplomeRequest ;
use App\http\Requests\UpdateDiplomeRequest ;


class DiplomeController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;

    public function __construct(DiplomeRepository $diplomeRepo)
    {
        $this->modelRepository = $diplomeRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.diplomes.index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.diplomes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiplomeRequest $request)
    {
        $input = $request->all();

        $diplome = $this->modelRepository->create($input);

        return redirect(route('diplomes.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $diplome = $this->modelRepository->find($id);

        if (empty($diplome)) {
            return redirect(route('diplomes.index'));
        }

        return view('backend.diplomes.show')->with('diplome', $diplome);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $diplome = $this->modelRepository->find($id);

        if (empty($diplome)) {
            return redirect(route('diplomes.index'));
        }

        return view('backend.diplomes.edit')->with('diplome', $diplome);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiplomeRequest $request, string $id)
    {
        $diplome = $this->modelRepository->find($id);

        if (empty($diplome)) {
            return redirect(route('diplomes.index'));
        }

        $diplome = $this->modelRepository->update($request->all(), $id);
        return redirect(route('diplomes.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $diplome = $this->modelRepository->find($id);

        if (empty($diplome)) {
            $message = "Diplôme introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "Diplôme supprimé avec succès";
        return $this->sendSuccessDialogResponse($message);
    }
}
