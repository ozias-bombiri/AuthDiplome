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
	protected $table = 'visas_diplomes';

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
		return $this->belongsTo(visaInstitution::class, 'visaInstitution_id');
	}

	public function visa()
	{
		return $this->belongsTo(Visa::class, 'visa_id');
	}
}
