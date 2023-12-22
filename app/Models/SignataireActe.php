<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InstitutionSignataire
 * 
 * @package App\Models
 */
class SignataireActe extends Model
{
	protected $table = 'signataires_actes';

	protected $casts = [
		'institution_id' => 'int',
		'signataire_id' => 'int',
		'categorieActe_id' => 'int',
		
	];

	protected $fillable = [
		'signataire_id',
		'institution_id',
		'statut',
		'debut',
		'fin',
		'fonction',
		'mention',
		'categorieActe_id'
	];

	public function institution()
	{
		return $this->belongsTo(Institution::class, 'institution_id');
	}

	public function signataire()
	{
		return $this->belongsTo(Signataire::class, 'signataire_id');
	}

	public function categorieActe()
	{
		return $this->belongsTo(CategorieActe::class, 'categorieActe_id');
	}
}
