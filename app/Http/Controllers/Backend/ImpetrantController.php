<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\ImpetrantRepository;
use App\Http\Requests\StoreImpetrantRequest;
use App\Http\Requests\UpdateImpetrantRequest;

class ImpetrantController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;

    public function __construct(ImpetrantRepository $impetrantRepo)
    {
        $this->modelRepository = $impetrantRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $impetrants = $this->modelRepository->all();
        return view('backend.impetrants.index', compact('impetrants'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.impetrants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImpetrantRequest $request)
    {
        $input = $request->all();

        $impetrant = $this->modelRepository->create($input);

        return redirect(route('impetrants.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $impetrant = $this->modelRepository->find($id);

        if (empty($impetrant)) {
            return redirect(route('impetrants.index'));
        }

        return view('backend.impetrants.show')->with('impetrant', $impetrant);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $impetrant = $this->modelRepository->find($id);

        if (empty($impetrant)) {
            return redirect(route('impetrants.index'));
        }

        return view('backend.impetrants.edit')->with('impetrant', $impetrant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImpetrantRequest $request, string $id)
    {
        $impetrant = $this->modelRepository->find($id);

        if (empty($impetrant)) {
            return redirect(route('impetrants.index'));
        }

        $impetrant = $this->modelRepository->update($request->all(), $id);
        return redirect(route('impetrants.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $impetrant = $this->modelRepository->find($id);

        if (empty($impetrant)) {
            $message = "impetrant introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "impetrant supprimé avec succès";
        return $this->sendSuccessDialogResponse($message);
    }
}
