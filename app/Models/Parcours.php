<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Parcours
 * 
 * @package App\Models
 */
class Parcours extends Model
{
    protected $table = 'parcours';

	protected $casts = [
		'filiere_id' => 'int',
		'niveauEtude_id' => 'int',
		'soutenance' => 'bool'
		
	];

	protected $fillable = [
		'intitule',
		'code',
		'soutenance',
		'domaine',
		'mention',
		'specialite',
		'description',
		'filiere_id',
		'niveauEtude_id'
	];

	public function filiere()
	{
		return $this->belongsTo(Filiere::class);
	}

	public function niveau_etude()
	{
		return $this->belongsTo(NiveauEtude::class, 'niveauEtude_id');
	}

	public function resultat_academiques()
	{
		return $this->hasMany(ResultatAcademique::class, 'parcours_id');
	}

	public function impetrants()
	{
		return $this->belongsToMany(Etudiant::class, 'inscriptions', 'parcours_id', 'impetrant_id');
	}

	
}
