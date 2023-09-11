<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Profile
 * 
 * @property int $id
 * @property string $intitule
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Profile extends Model
{
	protected $table = 'profiles';

	protected $fillable = [
		'intitule',
		'description'
	];

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
