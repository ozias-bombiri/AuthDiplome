<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Numeroteur
 * 
 * @property int $id
 * @property string $intitule
 * @property string $debut
 * @property string $fin
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 *
 * @package App\Models
 */
class Numeroteur extends Model
{
    protected $table = 'numeroteurs';

	protected $fillable = [
		'categorie',
		'compteur',
		'chaine',
		'institution_id'
	];

	public function institution()
	{
		return $this->belongsTo(Institution::class, 'institution_id');
	}
}
