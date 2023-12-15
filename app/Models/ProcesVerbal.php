<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProcesVerbal
 * 
 * @package App\Models
 */
class ProcesVerbal extends Model
{
    protected $table = 'proces_verbaux';

	protected $casts = [
		'parcours_id' => 'int',
		'anneeAcademique_id' => 'int',
		'nombreEtudiant' => 'int',
		'user_id' => 'int',
		
	];

	protected $fillable = [
		'intitule',
		'code',
		'dateDeliberation',
		'session',
		'description',
		'parcours_id',
		'anneeAcademique_id',
		'user_id',
	];

	public function Parcours()
	{
		return $this->belongsTo(Parcours::class);
	}

	public function anneeAcademique()
	{
		return $this->belongsTo(AnneeAcademique::class);
	}

	public function resultat_academiques()
	{
		return $this->hasMany(ResultatAcademique::class);
	}

	
}
