<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\UsersDataTable;
use App\Repositories\UserRepository;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;

    public function __construct(UserRepository $UserRepo)
    {
        $this->modelRepository = $UserRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('backend.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.users.create') ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $input = $request->all();

        $User = $this->modelRepository->create($input);

        //Flash::success('User enregistré avec succès.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $User = $this->modelRepository->find($id);

        if (empty($User)) {
            //Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('backend.users.show')->with('User', $User);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $User = $this->modelRepository->find($id);

        if (empty($User)) {
            //Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('backend.users.edit')->with('User', $User);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $User = $this->modelRepository->find($id);

        if (empty($User)) {
            //Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $User = $this->modelRepository->update($request->all(), $id);

        //Flash::success('User modifié avec succès.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $User = $this->modelRepository->find($id);

        if (empty($User)) {
            $message = "User introuvable";
            return $this->sendResponse($message);
        }

        $this->modelRepository->delete($id);

        $message = "User supprimé avec succès";
        return $this->sendSuccessDialogResponse($message);
    }
}
