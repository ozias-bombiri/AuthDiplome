<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ministere
 * 
 * @property int $id
 * @property string $sigle
 * @property string $denomitation
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|ResultatAcademique[] $resultat_academiques
 *
 * @package App\Models
 */

class Ministere extends Model
{
    protected $table = 'ministeres';

	protected $fillable = [
		'sigle',
		'denomination',
	];

	public function timbres()
	{
		return $this->hasMany(Timbre::class, 'ministere_id');
	}
}
