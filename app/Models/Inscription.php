<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Inscription
 * 
 * @property int $id
 * @property int $impetrant_id
 * @property int $parcours_id
 * @property string $referenceInscription
 * @property string $annee
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Parcours $parcours
 * @property Impetrant $impetrant
 *
 * @package App\Models
 */
class Inscription extends Model
{
	protected $table = 'inscriptions';

	protected $casts = [
		'parcours_id' => 'int',
		'impetrant_id' => 'int',
		
	];

	protected $fillable = [
		'impetrant_id',
		'parcours_id',
		'referenceInscription',
		'annee',
	];

	public function parcours()
	{
		return $this->belongsTo(Parcours::class);
	}

	public function impetrant()
	{
		return $this->belongsTo(Impetrant::class);
	}
}
