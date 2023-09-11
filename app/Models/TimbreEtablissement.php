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
 * @property int $etablissement_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Etablissement $etablissement
 *
 * @package App\Models
 */
class TimbreEtablissement extends Model
{
	protected $table = 'timbre_etablissements';

	protected $casts = [
		'etablissement_id' => 'int'
	];

	protected $fillable = [
		'intitule',
		'type',
		'ministere',
		'denomMinistere',
		'description',
		'etablissement_id'
	];

	public function etablissement()
	{
		return $this->belongsTo(Etablissement::class);
	}
}
