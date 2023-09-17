<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SignataireEtablissement
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
 * @property int $etablissement_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Etablissement $etablissement
 * @property Collection|AttestationProvisoire[] $attestation_provisoires
 *
 * @package App\Models
 */
class SignataireEtablissement extends Model
{
	protected $table = 'signataire_etablissements';

	protected $casts = [
		'etablissement_id' => 'int'
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
		'etablissement_id'
	];

	public function etablissement()
	{
		return $this->belongsTo(Etablissement::class);
	}

	public function attestation_provisoires()
	{
		return $this->hasMany(AttestationProvisoire::class, 'signataireEtablissement_id');
	}
}
