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

	

	public function inscription()
	{
		return $this->belongsTo(Inscription::class, 'inscription_id');
	}

	public function procesVerbal()
	{
		return $this->belongsTo(ProcesVerbal::class, 'procesVerbal_id');
	}

	public function acteAcademiques()
	{
		return $this->hasMany(ActeAcademique::class, 'resultatAcademique_id');
	}

	public function getActeByCategorie($categorie_id){
		$acte = ActeAcademique::join('resultat_academiques', 'acte_academiques.resultatAcademique_id', '=', 'resultat_academiques.id')
							->where('categorieActe_id', $categorie_id)
							->where('resultat_academiques.id', $this->id)
							->select('acte_academiques.*')
							->first();
		return $acte;

	}

}
