<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InstitutionSignataire
 * 
 * @package App\Models
 */
class SignataireActe extends Model
{
	protected $table = 'institutions_signataires';

	protected $casts = [
		'institution_id' => 'int',
		'signataire_id' => 'int',
		
	];

	protected $fillable = [
		'signataire_id',
		'institution_id',
		'statut',
		'debut',
		'fin',
		'fonction',
		'mention'
	];

	public function signataireInstitution()
	{
		return $this->belongsTo(SignataireInstitution::class);
	}

	public function signataires()
	{
		return $this->hasMany(Signataire::class);
	}
}
