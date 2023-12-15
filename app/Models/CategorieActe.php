<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategorieActe
 * 
 * 
 * @package App\Models
 */
class CategorieActe extends Model
{
    protected $table = 'categorie_actes';

	protected $fillable = [
		'intitule',
		'nombreCopies',
		'visas'
	];

	public function acteAcademiques()
	{
		return $this->hasMany(ActeAcademique::class);
	}
}
