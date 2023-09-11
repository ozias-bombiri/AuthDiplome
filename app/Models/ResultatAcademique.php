<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class ResultatAcademique
 * 
 * @property int $id
 * @property string $reference
 * @property bool $soutenance
 * @property Carbon $dateSignaure
 * @property float $moyenne
 * @property string $cote
 * @property string $session
 * @property Carbon $dateSoutenance
 * @property int $etudiant_id
 * @property int $parcours_id
 * @property int $anneeAcademique_id
 * @property int $document_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property AnneeAcademique $annee_academique
 * @property Document $document
 * @property Etudiant $etudiant
 * @property Parcour $parcour
 * @property Collection|AttestationDefinitive[] $attestation_definitives
 * @property Collection|AttestationProvisoire[] $attestation_provisoires
 * @property Collection|Diplome[] $diplomes
 *
 * @package App\Models
 */
class ResultatAcademique extends Model
{
	protected $table = 'resultat_academiques';

	protected $casts = [
		'soutenance' => 'bool',
		'dateSignaure' => 'datetime',
		'moyenne' => 'float',
		'dateSoutenance' => 'datetime',
		'etudiant_id' => 'int',
		'parcours_id' => 'int',
		'anneeAcademique_id' => 'int',
		'document_id' => 'int'
	];

	protected $fillable = [
		'reference',
		'soutenance',
		'dateSignaure',
		'moyenne',
		'cote',
		'session',
		'dateSoutenance',
		'etudiant_id',
		'parcours_id',
		'anneeAcademique_id',
		'document_id'
	];

	public function annee_academique()
	{
		return $this->belongsTo(AnneeAcademique::class, 'anneeAcademique_id');
	}

	public function document()
	{
		return $this->belongsTo(Document::class);
	}

	public function etudiant()
	{
		return $this->belongsTo(Etudiant::class);
	}

	public function parcour()
	{
		return $this->belongsTo(Parcour::class, 'parcours_id');
	}

	public function attestation_definitive():HasOne
	{
		return $this->hasOne(AttestationDefinitive::class, 'resultatAcademique_id');
	}

	public function attestation_provisoire():HasOne
	{
		return $this->hasOne(AttestationProvisoire::class, 'resultatAcademique_id');
	}

	public function diplome() : HasOne
	{
		return $this->hasOne(Diplome::class, 'resultatAcademique_id');
	}

}
