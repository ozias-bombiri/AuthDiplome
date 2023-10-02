<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ImpetrantInstitution
 * 
 * @property int $id
 * @property int $impetrant_id
 * @property int $institution_id
 * @property string $referenceInscription
 * @property string $annee
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Institution $institution
 * @property Impetrant $impetrant
 *
 * @package App\Models
 */
class InstitutionImpetrant extends Model
{
	protected $table = 'institutions_impetrants';

	protected $casts = [
		'impetrant_id' => 'int',
		'institution_id' => 'int',
		
	];

	protected $fillable = [
		'impetrant_id',
		'institution_id',
		'referenceInscription',
		'annee',
	];

	public function institution()
	{
		return $this->belongsTo(Institution::class);
	}

	public function impetrant()
	{
		return $this->belongsTo(Impetrant::class);
	}
}
