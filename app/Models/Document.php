<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 * 
 * 
 * @package App\Models
 */
class Document extends Model
{
	protected $table = 'documents';

	protected $casts = [
		'datecreation' => 'datetime',
		'acteAcademique_id' => 'int',
		'user_id' => 'int',
	];

	protected $fillable = [
		'reference',
		'numero',
		'dateGeneration',
		'nombreGeneration',
		'acteAcademique_id',
		'user_id',
	];

	public function acteAcademique()
	{
		return $this->belongsTo(ActeAcademique::class, 'acteAcademique_id');
	}
}
