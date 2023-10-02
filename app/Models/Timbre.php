<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TimbreEtablissement
 * 
 * @property int $id
 * @property string $intitule
 * @property string $type
 * @property string $ministere
 * @property string $denomMinistere
 * @property string $description
 * @property int $institution_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Institution $institution
 *
 * @package App\Models
 */
class Timbre extends Model
{
    protected $table = 'timbres';

	protected $casts = [
		'institution_id' => 'int'
	];

	protected $fillable = [
		'intitule',
		'type',
		'ministere',
		'denomMinistere',
		'description',
		'institution_id'
	];

	public function institution()
	{
		return $this->belongsTo(Institution::class);
	}
}
