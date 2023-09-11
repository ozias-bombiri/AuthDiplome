<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Visa
 * 
 * @property int $id
 * @property string $numero
 * @property string $intitule
 * @property Carbon $datesignaure
 * @property string $texte
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Diplome[] $diplomes
 *
 * @package App\Models
 */
class Visa extends Model
{
	protected $table = 'visas';

	protected $casts = [
		'datesignaure' => 'datetime'
	];

	protected $fillable = [
		'numero',
		'intitule',
		'datesignaure',
		'texte'
	];

	public function diplomes()
	{
		return $this->belongsToMany(Diplome::class, 'visa_diplomes')
					->withPivot('id', 'ordre')
					->withTimestamps();
	}
}
