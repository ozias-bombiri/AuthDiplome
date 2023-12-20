<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\InstitutionRepository;
use App\Repositories\CategorieActeRepository;
use App\Repositories\NumeroteurRepository;
use Illuminate\Http\Request;

class NumeroteurController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;
    private $institutionRepository;
    private $categorieRepository;

    public function __construct(
        NumeroteurRepository $anneeRepo, 
        InstitutionRepository $institutionRepo,
        CategorieActeRepository $categorieRepo,
        )
    {
        $this->modelRepository = $anneeRepo;
        $this->categorieRepository = $categorieRepo;
        $this->institutionRepository = $institutionRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $numeroteurs = $this->modelRepository->all();
        return view('backend.numeroteurs.index', compact('numeroteurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categorieRepository->all();
        $institutions = $this->institutionRepository->all();
        return view('backend.numeroteurs.create', compact('institutions','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $numeroteur = $this->modelRepository->create($input);

        return redirect(route('numeroteurs.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
