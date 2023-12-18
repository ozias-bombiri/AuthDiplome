<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NiveauEtude
 * 
 * 
 * @package App\Models
 */
class NiveauEtude extends Model
{
    protected $table = 'niveau_etudes';

	protected $fillable = [
		'intitule',
		'credit',
		'description'
	];

	public function parcours()
	{
		return $this->hasMany(Parcours::class);
	}
}
