<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class ResultatAcademique
 * 
 * @package App\Models
 */
class ResultatAcademique extends Model
{
	protected $table = 'resultat_academiques';

	protected $casts = [
		'moyenne' => 'float',
		'inscription_id' => 'int',
		'procesVerbal_id' => 'int',
		'user_id' => 'int',
	];

	protected $fillable = [
		'reference',
		'moyenne',
		'inscription_id',
		'procesVerbal_id',
		'user_id',
		
	];

	

	public function etudiant()
	{
		return $this->belongsTo(Etudiant::class);
	}

	public function procesVerbal()
	{
		return $this->belongsTo(ProcesVerbal::class);
	}

	public function acteAcademiques()
	{
		return $this->hasMany(ActeAcademique::class, 'resultatAcademique_id');
	}

}
