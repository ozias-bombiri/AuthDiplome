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
 * @property int $institution_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Institution $institution
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
