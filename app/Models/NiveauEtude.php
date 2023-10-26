<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NiveauEtude
 * 
 * @property int $id
 * @property string $intitule
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Parcour[] $parcours
 *
 * @package App\Models
 */
class NiveauEtude extends Model
{
    protected $table = 'niveau_etudes';

	protected $fillable = [
		'intitule',
		'credit',
		'description'
	];

	public function parcours()
	{
		return $this->hasMany(Parcour::class, 'niveauEtude_id');
	}
}
