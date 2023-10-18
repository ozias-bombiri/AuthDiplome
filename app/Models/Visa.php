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
 * @property Carbon $dateSignature
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
		'dateSignature' => 'datetime'
	];

	protected $fillable = [
		'numero',
		'intitule',
		'dateSignature',
		'texte'
	];

	public function diplomes()
	{
		return $this->belongsToMany(Diplome::class, 'visa_diplomes')
					->withPivot('id', 'ordre')
					->withTimestamps();
	}
}
