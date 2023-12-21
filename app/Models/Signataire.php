<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Signataire
 * 
 * @package App\Models
 */
class Signataire extends Model
{
    protected $table = 'signataires';

	protected $casts = [
		'institution_id' => 'int',
		
	];

	protected $fillable = [
		'nom',
		'prenom',
		'nip',
		'sexe',
		'grade',
		'titreAcademique',
		'titreHonorifique',
		
	];

	public function signataireActes()
	{
		return $this->hasMany(SignataireActe::class);
	}

}
