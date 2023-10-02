<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Signataire
 * 
 * @property int $id
 * @property string $nom
 * @property string $prenom
 * @property string $nip
 * @property string $sexe
 * @property string $typeDocument
 * @property string $fonction
 * @property string $fonctionLongue
 * @property string $titreAcademique
 * @property string $titreHonorifique
 * @property int $institution_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Institution $institution
 * @property Collection|AttestationProvisoire[] $attestation_provisoires
 *
 * @package App\Models
 */
class Signataire extends Model
{
    protected $table = 'signataires';

	protected $casts = [
		'institution_id' => 'int'
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
		'institution_id'
	];

	public function institution()
	{
		return $this->belongsTo(Institution::class);
	}

	public function attestation_provisoires()
	{
		return $this->hasMany(AttestationProvisoire::class, 'signataire_id');
	}
}
