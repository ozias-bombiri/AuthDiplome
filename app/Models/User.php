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
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string $statut
 * @property int $profile_id
 * @property int $etablissement_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Etablissement $etablissement
 * @property Profile $profile
 *
 * @package App\Models
 */
class User extends Authenticatable
{	
	use HasApiTokens, HasFactory, Notifiable,  HasRoles ;

	protected $table = 'users';

	protected $casts = [
		'email_verified_at' => 'datetime',
		'profile_id' => 'int',
		'etablissement_id' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'remember_token',
		'statut',
		'profile_id',
		'etablissement_id'
	];

	public function etablissement()
	{
		return $this->belongsTo(Etablissement::class);
	}

	/*public function profile()
	{
		return $this->belongsTo(Profile::class);
	}*/
}
