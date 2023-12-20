<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Repositories\CategorieActeRepository;
use App\Http\Requests\StoreCategorieActeRequest ;
use App\Http\Requests\UpdateCategorieActeRequest ;


class CategorieActeController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;

    public function __construct(CategorieActeRepository $categorieRepo)
    {
        $this->modelRepository = $categorieRepo;
    }

    public function index()
    {
        $categories = $this->modelRepository->all();
        return view('backend.categorie_actes.index', compact('categories'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.categorie_actes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategorieActeRequest $request)
    {
        $validated = $request->validated();
        $input = $request->all();

        $categorie = $this->modelRepository->create($input);

        return redirect(route('categorie_actes.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categorie = $this->modelRepository->find($id);

        if (empty($categorie)) {
            return redirect(route('categorie_actes.index'));
        }

        return view('backend.categorie_actes.show')->with('categorie', $categorie);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categorie = $this->modelRepository->find($id);

        if (empty($categorie)) {
            return redirect(route('categorie_actes.index'));
        }

        return view('backend.categorie_actes.edit')->with('categorie', $categorie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategorieActeRequest $request, string $id)
    {
        $validated = $request->validated();
        $input = $request->all();
        $categorie = $this->modelRepository->find($id);

        if (empty($categorie)) {
            return redirect(route('categorie_actes.index'));
        }
        
        $categorie = $this->modelRepository->update($input, $id);
        return redirect(route('categorie_actes.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categorie = $this->modelRepository->find($id);

        if (empty($categorie)) {
            $message = "Catégorie introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "Catégorie supprimée avec succès";
        return redirect(route('categorie_actes.index'));
    }

}
