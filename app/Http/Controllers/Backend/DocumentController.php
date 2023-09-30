<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\DocumentRepository;
use App\http\Requests\StoreDocumentRequest ;
use App\http\Requests\UpdateDocumentRequest ;


class DocumentController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;

    public function __construct(DocumentRepository $documentRepo)
    {
        $this->modelRepository = $documentRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.documents.index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.documents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocumentRequest $request)
    {
        $input = $request->all();

        $document = $this->modelRepository->create($input);

        return redirect(route('documents.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $document = $this->modelRepository->find($id);

        if (empty($document)) {
            return redirect(route('documents.index'));
        }

        return view('backend.documents.show')->with('document', $document);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $document = $this->modelRepository->find($id);

        if (empty($document)) {
            return redirect(route('documents.index'));
        }

        return view('backend.documents.edit')->with('document', $document);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentRequest $request, string $id)
    {
        $document = $this->modelRepository->find($id);

        if (empty($document)) {
            return redirect(route('documents.index'));
        }

        $document = $this->modelRepository->update($request->all(), $id);
        return redirect(route('documents.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $document = $this->modelRepository->find($id);

        if (empty($document)) {
            $message = "Document introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "Document supprimé avec succès";
        return $this->sendSuccessDialogResponse($message);
    }
}
