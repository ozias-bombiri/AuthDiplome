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
		'typeDocument',
		'fonction',
		'fonctionLongue',
		'grade',
		'titreAcademique',
		'titreHonorifique',
		
	];

	protected function nom():Attribute
	{
		return Attribute::make(
            get: fn (string $value) => strtoupper($value),
			set: fn (string $value) => strtoupper($value),
        );
	}

	public function institution()
	{
		return $this->belongsToMany(Institution::class, 'institutions_signataires', 'signataire_id', 'institution_id');
	}

	public function actes()
	{
		return $this->hasMany(ActeAcademique::class, 'signataire_id');
	}

}
