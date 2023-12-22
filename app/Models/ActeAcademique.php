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
		'categorieActe_id' => 'int',
		'resultatAcademique_id' => 'int',
		'signataireActe_id' => 'int',
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
		'signataireActe_id',
		'user_id',
		'reference',
	];

	public function categorieActe()
	{
		return $this->belongsTo(CategorieActe::class, 'categorieActe_id');
	}

	public function documents()
	{
		return $this->hasMany(Document::class, 'acteAcademique_id');
	}

	public function resultatAcademique()
	{
		return $this->belongsTo(ResultatAcademique::class, 'resultatAcademique_id');
	}

	public function signataireActe()
	{
		return $this->belongsTo(SignataireActe::class, 'signataireActe_id');
	}
}
