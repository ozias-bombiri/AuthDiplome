<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
/**
 * Class UserRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
		'email',
		'email_verified_at',
		'password',
		'remember_token',
		'statut',
		'institution_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    public function all($search = [], $skip = null, $limit = null, $columns = ['*']){
        $columns = ['id', 'name', 'email', 'statut', 'institution_id', ];
        $query = $this->allQuery($search, $skip, $limit);

        return $query->get($columns);
    }

    public function create($input)
    {
        $input['password'] = Hash::make($input['password']);
     
        return User::create($input);
        
    }

    public function update($input, $id)
    {
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
        $user = User::find($id);
        $user->update($input);

        return $user;
    }


}
