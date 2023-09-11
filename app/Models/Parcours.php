<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Parcours
 * 
 * @property int $id
 * @property string $intitule
 * @property string $credit
 * @property string $domaine
 * @property string $mention
 * @property string $specialite
 * @property string $description
 * @property int $etablissement_id
 * @property int $niveauEtude_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Etablissement $etablissement
 * @property NiveauEtude $niveau_etude
 * @property Collection|ResultatAcademique[] $resultat_academiques
 *
 * @package App\Models
 */
class Parcours extends Model
{
	protected $table = 'parcours';

	protected $casts = [
		'etablissement_id' => 'int',
		'niveauEtude_id' => 'int'
	];

	protected $fillable = [
		'intitule',
		'credit',
		'domaine',
		'mention',
		'specialite',
		'description',
		'etablissement_id',
		'niveauEtude_id'
	];

	public function etablissement()
	{
		return $this->belongsTo(Etablissement::class);
	}

	public function niveau_etude()
	{
		return $this->belongsTo(NiveauEtude::class, 'niveauEtude_id');
	}

	public function resultat_academiques()
	{
		return $this->hasMany(ResultatAcademique::class, 'parcours_id');
	}
}
