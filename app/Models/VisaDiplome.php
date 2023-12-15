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
 * @package App\Models
 */
class VisaDiplome extends Model
{
	protected $table = 'visa_diplomes';

	protected $casts = [
		'visa_id' => 'int',
		'visaInstitution_id' => 'int',
		'ordre' => 'int'
	];

	protected $fillable = [
		'visa_id',
		'visaInstitution_id',
		'ordre'
	];

	public function visaInstitution()
	{
		return $this->belongsTo(visaInstitution::class);
	}

	public function visa()
	{
		return $this->belongsTo(Visa::class);
	}
}
