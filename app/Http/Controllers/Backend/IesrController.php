<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\IesrDataTable;
use App\Repositories\IesrRepository;
use App\Http\Requests\StoreIesrRequest;
use App\Http\Requests\UpdateIesrRequest;
use Flash;


class IesrController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;

    public function __construct(IesrRepository $iesrRepo)
    {
        $this->modelRepository = $iesrRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(IesrDataTable $dataTable)
    {
        return $dataTable->render('backend.iesrs.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.iesrs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIesrRequest $request)
    {
        $input = $request->all();

        $iesr = $this->modelRepository->create($input);

        //Flash::success('iesr enregistré avec succès.');

        return redirect(route('iesrs.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $iesr = $this->modelRepository->find($id);

        if (empty($iesr)) {
            //Flash::error('iesr not found');

            return redirect(route('iesrs.index'));
        }

        return view('backend.iesrs.show')->with('iesr', $iesr);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $iesr = $this->modelRepository->find($id);

        if (empty($iesr)) {
            //Flash::error('iesr not found');

            return redirect(route('iesrs.index'));
        }

        return view('backend.iesrs.edit')->with('iesr', $iesr);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIesrRequest $request, string $id)
    {
        $iesr = $this->modelRepository->find($id);

        if (empty($iesr)) {
            //Flash::error('iesr not found');

            return redirect(route('iesrs.index'));
        }

        $iesr = $this->modelRepository->update($request->all(), $id);

        
        return redirect(route('iesrs.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $iesr = $this->modelRepository->find($id);

        if (empty($iesr)) {
            $message = "iesr introuvable";
            return redirect(route('iesrs.index'));
        }

        $this->modelRepository->delete($id);

        $message = "iesr supprimé avec succès";
        return redirect(route('iesrs.index'));
    }
}
