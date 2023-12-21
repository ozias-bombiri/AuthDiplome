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
		'categorieActe_id',
		'compteur',
		'chaine',
		'institution_id'
	];

	public function institution()
	{
		return $this->belongsTo(Institution::class);
	}

	public function categorieActe()
	{
		return $this->belongsTo(CategorieActe::class, 'categorieActe_id');
	}
}
