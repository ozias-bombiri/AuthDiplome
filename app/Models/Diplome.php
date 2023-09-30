<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Diplome
 * 
 * @property int $id
 * @property string $intitule
 * @property string $refrence
 * @property string $numeroEnregistrement
 * @property string $cote
 * @property Carbon $dateSignature
 * @property Carbon $dateCreation
 * @property int $resultatAcademique_id
 * @property int $signataire_id
 * @property int $document_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Document $document
 * @property ResultatAcademique $resultat_academique
 * @property SignataireIesr $signataire
 * @property Collection|Visa[] $visas
 *
 * @package App\Models
 */
class Diplome extends Model
{
	protected $table = 'diplomes';

	protected $casts = [
		'dateSignature' => 'datetime',
		'dateCreation' => 'datetime',
		'resultatAcademique_id' => 'int',
		'signataire_id' => 'int',
		'document_id' => 'int'
	];

	protected $fillable = [
		'intitule',
		'reference',
		'numeroEnregistrement',
		'cote',
		'dateSignature',
		'dateCreation',
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

	public function signataire_iesr()
	{
		return $this->belongsTo(Signataire::class, 'signataire_id');
	}

	public function visas()
	{
		return $this->belongsToMany(Visa::class, 'visa_diplomes')
					->withPivot('id', 'ordre')
					->withTimestamps();
	}
}
