<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategorieSignataire
 * 
 * 
 * @package App\Models
 */
class CategorieSignataire extends Model
{
    protected $table = 'categorie_signataires';

	protected $fillable = [
		'intitule',
		'fonction',
		'mention'
	];

	public function signataires()
	{
		return $this->hasMany(Signataire::class);
	}
}
