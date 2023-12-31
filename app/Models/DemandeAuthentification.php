<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DemandeAuthentification
 * 
 * 
 * @package App\Models
 */
class DemandeAuthentification extends Model
{
	protected $table = 'demande_authentifications';

	protected $casts = [
		'dateDemande' => 'datetime',
		
	];

	protected $fillable = [
		'reference',
		'reponse',
		'dateDemande',
		'demandeur',
		'description',
	];

	
}
