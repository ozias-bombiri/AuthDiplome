<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Visa
 * 
 * @package App\Models
 */
class Visa extends Model
{
    protected $table = 'visas';

	protected $casts = [
		'dateSignature' => 'datetime'
	];

	protected $fillable = [
		'numero',
		'intitule',
		'categorie',
		'dateSignature',
		'texte'
	];

	public function institutions()
	{
		return $this->belongsToMany(Institution::class, 'visa_diplomes', 'visa_id', 'institution_id');
	}
}
