<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VisaInstitution
 * 
 * @package App\Models
 */
class VisaInstitution extends Model
{
	protected $table = 'visas_institutions';

	protected $casts = [
		'categorieActe_id' => 'int',
		'institution_id' => 'int',
		
	];

	protected $fillable = [
		'categorieActe_id',
		'institution_id',
		'intitule'
	];

	public function institution()
	{
		return $this->belongsTo(Institution::class, 'institution_id');
	}

	public function visaDiplomes() 
	{
		return $this->hasMany(VisaDiplome::class, 'visaInstitution_id', 'visas_diplomes', 'id');
	}

	public function categorieActe()
	{
		return $this->belongsTo(CategorieActe::class, 'categorieActe_id');
	}
}
