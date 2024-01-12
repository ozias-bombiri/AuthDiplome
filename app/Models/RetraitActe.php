<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RetraitActe
 * 
 * 
 * @package App\Models
 */
class RetraitActe extends Model
{
    protected $table = 'retrait_actes';

	protected $fillable = [
		'reference',
		'dateRetrait',
		'retirant',
		'description',
		'acteAcademique_id',
		'user_id'

	];

	public function acteAcademique()
	{
		return $this->belongsTo(ActeAcademique::class, 'acteAcademique_id');
	}
}
