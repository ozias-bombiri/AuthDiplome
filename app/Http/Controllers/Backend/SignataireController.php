<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\SignataireRepository;
use App\Http\Requests\StoreSignataireRequest;
use App\Http\Requests\UpdateSignataireRequest;
use App\Repositories\CategorieActeRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\SignataireActeRepository;
use Illuminate\Http\Request;

class SignataireController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;
    private $institutionRepository;
    private $categorieActeRepository ;
    private $signataireActeRepository;
   
     public function __construct(SignataireRepository $signataireRepo, 
                        InstitutionRepository $institutionRepo, 
                        CategorieActeRepository $categorieActeRepo,
                        SignataireActeRepository $signataireActeRepo)
    {
        $this->modelRepository = $signataireRepo;
        $this->institutionRepository = $institutionRepo;
        $this->categorieActeRepository = $categorieActeRepo;
        $this->signataireActeRepository = $signataireActeRepo ;
        $this->categorieActeRepository = $categorieActeRepo;
        $this->signataireActeRepository = $signataireActeRepo ;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $signataireActes = $this->signataireActeRepository->all();
        return view('backend.signataires.index', compact(('signataireActes')));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categorieActeRepository->all();
        $categories = $this->categorieActeRepository->all();
        $institutions = $this->institutionRepository->all();
        return view('backend.signataires.create', compact('institutions', 'categories')) ;
        return view('backend.signataires.create', compact('institutions', 'categories')) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSignataireRequest $request)
    {
        $input = $request->all();

        $signataire = $this->modelRepository->create($input);
        $signataireActe = [];
        $signataireActe['statut']  = true;
        $signataireActe['debut']  = $input['debut'];
        $signataireActe['fonction']  = $input['fonction'];
        $signataireActe['mention']  = $input['mention'];
        $signataireActe['categorieActe_id']  = $input['categorieActe_id'];
        $signataireActe['institution_id']  = $input['institution_id'];
        $signataireActe['signataire_id']  = $signataire->id;
        $this->signataireActeRepository->create($signataireActe);
        
        return redirect(route('signataires.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $signataire = $this->modelRepository->find($id);

        if (empty($signataire)) {
            //Flash::error('signataire not found');

            return redirect(route('signataires.index'));
        }

        return view('backend.signataires.show')->with('signataire', $signataire);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $signataire = $this->modelRepository->find($id);

        if (empty($signataire)) {
            //Flash::error('signataire not found');

            return redirect(route('signataires.index'));
        }
        $institutions = $this->institutionRepository->all();
        if ($request->ajax()) {
            $data = [];
            if(empty($signataire)){
                $data = "Nothing";
            }
            else {
                $data = [
                    'institutions' => $institutions,
                    'signataire' => $signataire                
                ];
            }
            return response()->json(['result' =>$data]);
        }
        
        return view('backend.signataires.edit', compact('signataire', 'institutions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSignataireRequest $request, string $id)
    {
        $valididated = $request->validated();
        $signataire = $this->modelRepository->find($id);

        if (empty($signataire)) {
            //Flash::error('signataire not found');

            return redirect(route('signataires.index'));
        }

        $signataire = $this->modelRepository->update($request->all(), $id);

        //Flash::success('signataire modifié avec succès.');

        return redirect(route('signataires.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $signataire = $this->modelRepository->find($id);

        if (empty($signataire)) {
            $message = "signataire introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        return redirect(route('signataires.index'));
    }
}
