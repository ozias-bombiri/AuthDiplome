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
 * @property int $id
 * @property int $signataire_id
 * @property int $institution_id
 * @property string $referenceInscription
 * @property string $annee
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Institution $institution
 * @property Signataire $signataire
 *
 * @package App\Models
 */
class InstitutionSignataire extends Model
{
	protected $table = 'institutions_signataires';

	protected $casts = [
		'institution_id' => 'int',
		'signataire_id' => 'int',
		
	];

	protected $fillable = [
		'signataire_id',
		'institution_id',
		'typeDocument',
		'statut',
		'debut',
		'fin'
	];

	public function institution()
	{
		return $this->belongsTo(Institution::class);
	}

	public function signataire()
	{
		return $this->belongsTo(Signataire::class);
	}
}
