<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;	//Spatie laravel


/**
 * Class User
 * 
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,  HasRoles ;

	protected $table = 'users';

	protected $casts = [
		'email_verified_at' => 'datetime',
		'institution_id' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'nom',
		'prenom',
		'telephone',
		'email',
		'email_verified_at',
		'password',
		'remember_token',
		'statut',
		'institution_id'
	];

	public function institution()
	{
		return $this->belongsTo(Institution::class);
	}

	public function getRoles()
	{
		return $this->getRoleNames();
	}

}
