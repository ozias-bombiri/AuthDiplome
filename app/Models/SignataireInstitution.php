<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SignataireInstitution
 * 
 * @package App\Models
 */
class SignataireInstitution extends Model
{
	protected $table = 'signataires_institutions';

	protected $casts = [
		'institution_id' => 'int',
		'categorieSignataire_id' => 'int',
		
	];

	protected $fillable = [
		'categorieSignataire_id',
		'institution_id',
		'intitule',
		
	];

	public function institution()
	{
		return $this->belongsTo(Institution::class);
	}

	public function categorieSignataire()
	{
		return $this->belongsTo(CategorieSignataire::class);
	}
}
