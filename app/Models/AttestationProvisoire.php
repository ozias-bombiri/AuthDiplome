<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AttestationProvisoire
 * 
 * @property int $id
 * @property string $intitule
 * @property string $reference
 * @property Carbon $dateCreation
 * @property Carbon $dateSignature
 * @property bool $statutGeneration
 * @property int $resultatAcademique_id
 * @property int $signataire_id
 * @property int $document_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Document $document
 * @property ResultatAcademique $resultat_academique
 * @property SignataireEtablissement $signataire
 *
 * @package App\Models
 */
class AttestationProvisoire extends Model
{
	protected $table = 'attestation_provisoires';

	protected $casts = [
		'dateCreation' => 'datetime',
		'dateSignature' => 'datetime',
		'statutGeneration' => 'bool',
		'resultatAcademique_id' => 'int',
		'signataire_id' => 'int',
		'document_id' => 'int'
	];

	protected $fillable = [
		'intitule',
		'reference',
		'dateCreation',
		'lieuCreation',
		'dateSignature',
		'statutGeneration',
		'resultatAcademique_id',
		'signataire_id',
		'document_id'
	];

	public function document()
	{
		return $this->belongsTo(Document::class);
	}

	public function resultat_academique()
	{
		return $this->belongsTo(ResultatAcademique::class, 'resultatAcademique_id');
	}

	public function signataire()
	{
		return $this->belongsTo(Signataire::class, 'signataire_id');
	}
}
