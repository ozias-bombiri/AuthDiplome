<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVisaRequest;
use App\Http\Requests\UpdateVisaRequest;
use App\Repositories\VisaRepository;

class VisaController extends Controller
{
    protected $modelRepository ;

    public function __construct(VisaRepository $visaRepo)
    {
        $this->modelRepository = $visaRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visas = $this->modelRepository->all();
        return view('backend.visas.index', compact('visas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.visas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVisaRequest $request)
    {
        $validated = $request->validated();
        $input = $request->all();
        $visa = $this->modelRepository->create($input);
        return redirect(route('visas.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $visa = $this->modelRepository->find($id);
        return view('backend.visas.show', compact('visa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $visa = $this->modelRepository->find($id);
        return view('backend.visas.edit', compact('visa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVisaRequest $request, string $id)
    {
        $validated = $request->validated();
        $input = $request->all();
        $visa = $this->modelRepository->update($input, $id);
        return redirect(route('visas.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
        $visa = $this->modelRepository->find($id);
        if(!empty($visa)) {
            $this->modelRepository->delete($id);
        }
        return redirect(route('visas.index'));
    }
}
