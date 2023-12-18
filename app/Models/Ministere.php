<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ministere
 * 
 * 
 * @package App\Models
 */

class Ministere extends Model
{
    protected $table = 'ministeres';

	protected $fillable = [
		'sigle',
		'denomination',
	];

	public function timbres()
	{
		return $this->hasMany(Timbre::class);
	}
}
