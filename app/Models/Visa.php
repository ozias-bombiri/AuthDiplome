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

	public function visaDiplomes() 
	{
		return $this->hasMany(VisaDiplome::class, 'visa_id', 'visas_diplomes', 'id');
	}
}
