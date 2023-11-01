<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Repositories\InstitutionRepository;

class UserController extends Controller
{
    /** @var  modelRepository */
    private $modelRepository;
    private $institutionRepository;

    public function __construct(UserRepository $UserRepo, InstitutionRepository $institutionRepo)
    {
        $this->modelRepository = $UserRepo;
        $this->institutionRepository = $institutionRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $utilisateurs = $this->modelRepository->all();
        return view('backend.users.index',compact('utilisateurs'));
            
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $institutions = $this->institutionRepository->all();
        $roles = Role::pluck('name','name')->all();
        return view('backend.users.create',compact('roles', 'institutions'));
    }

    // public function create()
    // {
    //     return view('backend.users.create') ;
    // }



    /**
     * Store a newly created resource in storage.
     */

     public function store(StoreUserRequest $request)
     {
         $validated =  $request->validated();     
         $input = $request->all();
         $user = $this->modelRepository->create($input);
         $type = $input['type'];
         if($type == 1){
            $user->assignRole('direction');
         }
         elseif($type ==2){
            $user->assignRole('daoi');
         }
         elseif($type ==3){
            $user->assignRole('authentification');
         }
         elseif($type ==4){
            $user->assignRole('admin');
         }
         return redirect()->route('users.index')
                         ->with('success','User created successfully');
     }
     


    // public function store(StoreUserRequest $request)
    // {
    //     $input = $request->all();

    //     $User = $this->modelRepository->create($input);

    //     //Flash::success('User enregistré avec succès.');

    //     return redirect(route('users.index'));
    // }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('backend.users.show',compact('user'));
    }


    // public function show(string $id)
    // {
    //     $User = $this->modelRepository->find($id);

    //     if (empty($User)) {
    //         //Flash::error('User not found');

    //         return redirect(route('users.index'));
    //     }

    //     return view('backend.users.show')->with('User', $User);
    // }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {

        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $institutions = $this->institutionRepository->all();
        
        return view('backend.users.edit',compact('user','roles','userRole', 'institutions'));
    }


    // public function edit(string $id)
    // {
    //     $User = $this->modelRepository->find($id);

    //     if (empty($User)) {
    //         //Flash::error('User not found');

    //         return redirect(route('users.index'));
    //     }

    //     return view('backend.users.edit')->with('User', $User);
    // }

    /**
     * Update the specified resource in storage.
     */

     public function update(UpdateUserRequest $request, $id)
     {
        $validated =  $request->validated(); 
     
         $input = $request->all(); 
                 
     
         $user = $this->modelRepository->update($input, $id);
         
         DB::table('model_has_roles')->where('model_id',$id)->delete();
     
         $user->assignRole($request->input('roles'));
     
         return redirect()->route('users.index')
                         ->with('success','User updated successfully');
     }




    // public function update(UpdateUserRequest $request, string $id)
    // {
    //     $User = $this->modelRepository->find($id);

    //     if (empty($User)) {
    //         //Flash::error('User not found');

    //         return redirect(route('users.index'));
    //     }

    //     $User = $this->modelRepository->update($request->all(), $id);

    //     //Flash::success('User modifié avec succès.');

    //     return redirect(route('users.index'));
    // }

    /**
     * Remove the specified resource from storage.
     */

     public function destroy($id)
     {
         $this->modelRepository->delete($id);
         return redirect()->route('users.index')
                         ->with('success','User deleted successfully');
     }





    // public function destroy(string $id)
    // {
    //     $User = $this->modelRepository->find($id);

    //     if (empty($User)) {
    //         $message = "User introuvable";
    //         return $this->sendResponse($message);
    //     }

    //     $this->modelRepository->delete($id);

    //     $message = "User supprimé avec succès";
    //     return $this->sendSuccessDialogResponse($message);
    // }
}
