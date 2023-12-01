<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Filiere
 * 
 * @property int $id
 * @property string $intitule
 * @property string $debut
 * @property string $fin
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Parcours[] $parcours
 *
 * @package App\Models
 */
class Filiere extends Model
{
    protected $table = 'filieres';

	protected $casts = [
		'institution_id' => 'int',
	];

	protected $fillable = [
		'intitule',
		'sigle',
		'code',
		'institution_id',
		'description',
	];

	public function parcours()
	{
		return $this->hasMany(Parcours::class, 'filiere_id');
	}

	public function institution()
	{
		return $this->belongsTo(Institution::class);
	}
}
