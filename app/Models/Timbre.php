<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Timbre
 * 
 * @package App\Models
 */

class Timbre extends Model
{
    protected $table = 'timbres';

	protected $casts = [
		'institution_id' => 'int',
		'ministere_id' => 'int'
	];

	protected $fillable = [
		'intitule',
		'type',
		'description',
		'institution_id',
		'ministere_id'
	];

	public function institution()
	{
		return $this->belongsTo(Institution::class, 'institution_id');
	}

	public function ministere()
	{
		return $this->belongsTo(Ministere::class, 'ministere_id');
	}
}
