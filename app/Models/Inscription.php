<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Inscription
 * 
 *
 * @package App\Models
 */
class Inscription extends Model
{
	protected $table = 'inscriptions';

	protected $casts = [
		'parcours_id' => 'int',
		'etudiant_id' => 'int',
		
	];

	protected $fillable = [
		'etudiant_id',
		'parcours_id',
		'referenceInscription',
		'annee',
	];

	public function parcours()
	{
		return $this->belongsTo(Parcours::class);
	}

	public function etudiant()
	{
		return $this->belongsTo(Etudiant::class);
	}
}
