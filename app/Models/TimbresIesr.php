<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TimbresIesr
 * 
 * @property int $id
 * @property string $intitule
 * @property string $type
 * @property string $ministere
 * @property string $denomMinistere
 * @property string $description
 * @property int $iesr_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Iesr $iesr
 *
 * @package App\Models
 */
class TimbresIesr extends Model
{
	protected $table = 'timbres_iesrs';

	protected $casts = [
		'iesr_id' => 'int'
	];

	protected $fillable = [
		'intitule',
		'type',
		'ministere',
		'denomMinistere',
		'description',
		'iesr_id'
	];

	public function iesr()
	{
		return $this->belongsTo(Iesr::class);
	}
}
