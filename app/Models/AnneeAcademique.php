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
 * @property int $id
 * @property string $intitule
 * @property string $debut
 * @property string $fin
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|ResultatAcademique[] $resultat_academiques
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

	public function resultat_academiques()
	{
		return $this->hasMany(ResultatAcademique::class, 'anneeAcademique_id');
	}
}
