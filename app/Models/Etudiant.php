<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Etudiant
 * 
 * 
 * @package App\Models
 */
class Etudiant extends Model
{
    protected $table = 'etudiants';

	protected $casts = [
		'dateNaissance' => 'datetime',
		'nevers' => 'boolean'
	];

	protected $fillable = [
		'identifiant',
		'typeIdentifiant',
		'nom',
		'prenom',
		'sexe',
		'dateNaissance',
		'nevers',
		'lieuNaissance',
		'paysNaissance'
	];


	public function resultat_academiques()
	{
		return $this->hasMany(ResultatAcademique::class);
	}

	public function parcours()
	{
		return $this->belongsToMany(Parcours::class, 'inscriptions', 'etudiant_id', 'parcours_id');
	}

	


}
