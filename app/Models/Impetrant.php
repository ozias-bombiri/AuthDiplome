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
 * Class Etudiant
 * 
 * @property int $id
 * @property string $identifiant
 * @property string $typeIdentifiant
 * @property string $nom
 * @property string $prenom
 * @property string $sexe
 * @property Carbon $dateNaissance
 * @property string $lieuNaissance
 * @property string $paysNaissance
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|ResultatAcademique[] $resultat_academiques
 *
 * @package App\Models
 */
class Impetrant extends Model
{
    protected $table = 'impetrants';

	protected $casts = [
		'dateNaissance' => 'datetime',
		'nevers' => 'boolean'
	];

	protected $fillable = [
		'identifiant',
		'typeIdentifiant',
		'nom',
		'prenom',
		'sexe',
		'dateNaissance',
		'nevers',
		'lieuNaissance',
		'paysNaissance'
	];

	protected function nom():Attribute
	{
		return Attribute::make(
            get: fn (string $value) => strtoupper($value),
			set: fn (string $value) => strtoupper($value),
        );
	}

	public function resultat_academiques()
	{
		return $this->hasMany(ResultatAcademique::class);
	}

	public function institutions()
	{
		return $this->belongsToMany(Institution::class, 'institutions_impetrants', 'impetrant_id', 'institution_id');
	}


}
