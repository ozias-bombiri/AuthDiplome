<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AnneeAcademique
 * 
 * 
 * @package App\Models
 */
class AnneeAcademique extends Model
{
    protected $table = 'annee_academiques';

	protected $fillable = [
		'intitule',
		'debut',
		'fin'
	];

	public function procesVerbaux()
	{
		return $this->hasMany(ProcesVerbal::class);
	}

	public function Inscriptions()
	{
		return $this->hasMany(Inscription::class);
	}
}
