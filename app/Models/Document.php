<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 * 
 * @property int $id
 * @property string $reference
 * @property Carbon $datecreation
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|AttestationDefinitive[] $attestation_definitives
 * @property Collection|AttestationProvisoire[] $attestation_provisoires
 * @property Collection|Diplome[] $diplomes
 * @property Collection|ResultatAcademique[] $resultat_academiques
 *
 * @package App\Models
 */
class Document extends Model
{
	protected $table = 'documents';

	protected $casts = [
		'datecreation' => 'datetime',
		'user_id' => 'int',
	];

	protected $fillable = [
		'reference',
		'datecreation',
		'type',
		'user_id',
	];

	public function attestation_definitives()
	{
		return $this->hasMany(AttestationDefinitive::class);
	}

	public function attestation_provisoires()
	{
		return $this->hasMany(AttestationProvisoire::class);
	}

	public function diplomes()
	{
		return $this->hasMany(Diplome::class);
	}

	public function resultat_academiques()
	{
		return $this->hasMany(ResultatAcademique::class);
	}
}
