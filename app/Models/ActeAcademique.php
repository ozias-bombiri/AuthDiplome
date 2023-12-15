<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ActeAcademique
 * 
 * 
 * @package App\Models
 */
class ActeAcademique extends Model
{
	protected $table = 'acte_academiques';

	protected $casts = [
		'numero' => 'int',
		'dateSignature' => 'datetime',
		'statutSignature' => 'boolean',
		'statutRemise' => 'boolean',
		'validite' => 'boolean',
		'categorieActe' => 'int',
		'resultatAcademique_id' => 'int',
		'signataire_id' => 'int',
		'user_id' => 'int',
		
	];

	protected $fillable = [
		'intitule',
		'numero',
		'dateSignature',
		'lieu',
		'statutSignature',
		'statutRemise',
		'categorieActe_id',
		'resultatAcademique_id',
		'signataire_id',
		'user_id',
	];

	public function categorieActe()
	{
		return $this->belongsTo(CategorieActe::class);
	}

	public function documents()
	{
		return $this->hasMany(Document::class);
	}

	public function resultat_academique()
	{
		return $this->belongsTo(ResultatAcademique::class, 'resultatAcademique_id');
	}

	public function signataire()
	{
		return $this->belongsTo(Signataire::class, 'signataire_id');
	}
}
