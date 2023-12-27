<?php

namespace App\Http\Controllers\Backend; 

use App\Http\Controllers\Controller;

use App\Repositories\RetraitActeRepository;
use App\Http\Requests\StoreRetraitActeRequest ;
use App\Http\Requests\UpdateRetraitActeRequest ;
use App\Repositories\ActeAcademiqueRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;


class RetraitActeController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository; 
    private $acteAcademiqueRepository;

    public function __construct(
        RetraitActeRepository $retraitRepo,
        ActeAcademiqueRepository $acteAcademiqueRepo
        )
    {
        $this->modelRepository = $retraitRepo;
        $this->acteAcademiqueRepository = $acteAcademiqueRepo;
    }

    public function index()
    {
        $retraits = $this->modelRepository->all();
        return view('backend.retrait_actes.index', compact('retraits'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $acteAcademiques = $this->acteAcademiqueRepository->all();
        return view('backend.retrait_actes.create', compact('acteAcademiques'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRetraitActeRequest $request)
    {
        //$validated = $request->validated();

        $user_id = Auth::id(); 
        $input = $request->all();
        $input['user_id'] = $user_id; 
        $retrait = $this->modelRepository->create($input);
        
        return redirect(route('retrait_actes.index'));
    }

    public function saveRemiseActe(StoreRetraitActeRequest $request, $id)
    {
        //$validated = $request->validated();

        $user_id = Auth::id(); 
        $input = $request->all();
        $input['user_id'] = $user_id; 
        $retrait = $this->modelRepository->create($input);
        
        return redirect(route('actes.provisoires.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $retrait = $this->modelRepository->find($id);

        if (empty($retrait)) {
            return redirect(route('retrait_actes.index'));
        }

        return view('backend.retrait_actes.show')->with('retrait', $retrait);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $retrait = $this->modelRepository->find($id);

        if (empty($retrait)) {
            return redirect(route('retrait_actes.index'));
        }

        return view('backend.retrait_actes.edit')->with('retrait', $retrait);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRetraitActeRequest $request, string $id)
    {
        $validated = $request->validated();
        $input = $request->all();
        $retrait = $this->modelRepository->find($id);

        if (empty($retrait)) {
            return redirect(route('retrait_actes.index'));
        }
        
        $retrait = $this->modelRepository->update($input, $id);
        return redirect(route('retrait_actes.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $retrait = $this->modelRepository->find($id);

        if (empty($retrait)) {
            $message = "Retrait acte introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "Retrait acte supprimé avec succès";
        return redirect(route('retrait_actes.index'));
    }

}
