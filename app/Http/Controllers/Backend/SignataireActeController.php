<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Repositories\SignataireActeRepository;
use App\Http\Requests\StoreSignataireActeRequest ;
use App\Http\Requests\UpdateSignataireActeRequest ;
use App\Repositories\CategorieActeRepository;
use App\Repositories\SignataireRepository;
use App\Repositories\InstitutionRepository;


class SignataireActeController extends Controller
{
    /** @var  modelRepository */ 
    private $modelRepository;
    private $categorieRepository;
    private $signataireRepository;
    private $institutionRepository;

    public function __construct(
        SignataireActeRepository $signActeRepo,
        CategorieActeRepository $categorieRepo,
        SignataireRepository $signataireRepo,
        InstitutionRepository $institutionRepo
        )
    {
        $this->modelRepository = $signActeRepo;
        $this->categorieRepository = $categorieRepo;
        $this->signataireRepository = $signataireRepo;
        $this->institutionRepository = $institutionRepo;
    }

    public function index()
    {
        $sign_actes = $this->modelRepository->all();
        return view('backend.signataire_actes.index', compact('sign_actes'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categorieRepository->all();
        $signataires = $this->signataireRepository->all();
        $institutions = $this->institutionRepository->all();
        return view('backend.signataire_actes.create', compact('categories','signataires','institutions'));
    }

    /** 
     * Store a newly created resource in storage.
     */
    public function store(StoreSignataireActeRequest $request)
    {
        $validated = $request->validated();
        $input = $request->all();

        $sign_acte = $this->modelRepository->create($input);

        return redirect(route('signataire_actes.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sign_acte = $this->modelRepository->find($id);

        if (empty($sign_acte)) {
            return redirect(route('signataire_actes.index'));
        }

        return view('backend.signataire_actes.show')->with('sign_acte', $sign_acte);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sign_acte = $this->modelRepository->find($id);

        if (empty($sign_acte)) {
            return redirect(route('signataire_actes.index'));
        }

        return view('backend.signataire_actes.edit')->with('sign_acte', $sign_acte);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSignataireActeRequest $request, string $id)
    {
        $validated = $request->validated();
        $input = $request->all();
        $sign_acte = $this->modelRepository->find($id);

        if (empty($sign_acte)) {
            return redirect(route('signataire_actes.index'));
        }
        
        $sign_acte = $this->modelRepository->update($input, $id);
        return redirect(route('signataire_actes.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sign_acte = $this->modelRepository->find($id);

        if (empty($sign_acte)) {
            $message = "Signataire acte introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "Signataire acte supprimé avec succès";
        return redirect(route('signataire_actes.index'));
    }

}
