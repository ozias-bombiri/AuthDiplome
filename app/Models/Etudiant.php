<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
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
class Etudiant extends Model
{
	protected $table = 'etudiants';

	protected $casts = [
		'dateNaissance' => 'datetime'
	];

	protected $fillable = [
		'identifiant',
		'typeIdentifiant',
		'nom',
		'prenom',
		'sexe',
		'dateNaissance',
		'lieuNaissance',
		'paysNaissance'
	];

	public function resultat_academiques()
	{
		return $this->hasMany(ResultatAcademique::class);
	}
}
