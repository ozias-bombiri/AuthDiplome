<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AttestationDefinitive
 * 
 * @property int $id
 * @property string $intitule
 * @property Carbon $dateSignaure
 * @property string $reference
 * @property Carbon $dateCreation
 * @property int $resultatAcademique_id
 * @property int $signataireIesr_id
 * @property int $document_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Document $document
 * @property ResultatAcademique $resultat_academique
 * @property SignataireIesr $signataire_iesr
 *
 * @package App\Models
 */
class AttestationDefinitive extends Model
{
	protected $table = 'attestation_definitives';

	protected $casts = [
		'dateSignaure' => 'datetime',
		'dateCreation' => 'datetime',
		'resultatAcademique_id' => 'int',
		'signataireIesr_id' => 'int',
		'document_id' => 'int'
	];

	protected $fillable = [
		'intitule',
		'dateSignaure',
		'reference',
		'dateCreation',
		'resultatAcademique_id',
		'signataireIesr_id',
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

	public function signataire_iesr()
	{
		return $this->belongsTo(SignataireIesr::class, 'signataireIesr_id');
	}
}
