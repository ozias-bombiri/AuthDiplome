<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Repositories\MinistereRepository;
use App\Http\Requests\StoreMinistereRequest ;
use App\Http\Requests\UpdateMinistereRequest ;


class MinistereController extends Controller
{
    /** @var  modelRepository */ 
    private $modelRepository; 

    public function __construct(MinistereRepository $ministereRepo)
    {
        $this->modelRepository = $ministereRepo;
    }

    public function index()
    {
        $ministeres = $this->modelRepository->all();
        return view('backend.ministeres.index', compact('ministeres'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.ministeres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMinistereRequest $request)
    {
        $validated = $request->validated();
        $input = $request->all();

        $ministere = $this->modelRepository->create($input);

        return redirect(route('ministeres.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ministere = $this->modelRepository->find($id);

        if (empty($ministere)) {
            return redirect(route('ministeres.index'));
        }

        return view('backend.ministeres.show')->with('ministere', $ministere);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ministere = $this->modelRepository->find($id);

        if (empty($ministere)) {
            return redirect(route('ministeres.index'));
        }

        return view('backend.ministeres.edit')->with('ministere', $ministere);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMinistereRequest $request, string $id)
    {
        $validated = $request->validated();
        $input = $request->all();
        $ministere = $this->modelRepository->find($id);

        if (empty($ministere)) {
            return redirect(route('ministeres.index'));
        }
        
        $ministere = $this->modelRepository->update($input, $id);
        return redirect(route('ministeres.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ministere = $this->modelRepository->find($id);

        if (empty($ministere)) {
            $message = "Ministère introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "Ministère supprimé avec succès";
        return redirect(route('ministeres.index'));
    }

}
