<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Numeroteur
 * 
 * 
 * @package App\Models
 */
class Numeroteur extends Model
{
    protected $table = 'numeroteurs';

	protected $fillable = [
		'categorie',
		'compteur',
		'chaine',
		'institution_id'
	];

	public function institution()
	{
		return $this->belongsTo(Institution::class, 'institution_id');
	}
}
