<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VisaDiplome
 * 
 * @property int $id
 * @property int $visa_id
 * @property int $diplome_id
 * @property int $ordre
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Diplome $diplome
 * @property Visa $visa
 *
 * @package App\Models
 */
class VisaDiplome extends Model
{
	protected $table = 'visa_diplomes';

	protected $casts = [
		'visa_id' => 'int',
		'diplome_id' => 'int',
		'ordre' => 'int'
	];

	protected $fillable = [
		'visa_id',
		'diplome_id',
		'ordre'
	];

	public function diplome()
	{
		return $this->belongsTo(Diplome::class);
	}

	public function visa()
	{
		return $this->belongsTo(Visa::class);
	}
}
