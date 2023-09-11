<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SignataireIesr
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
 * @property int $iesr_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Iesr $iesr
 * @property Collection|AttestationDefinitive[] $attestation_definitives
 * @property Collection|Diplome[] $diplomes
 *
 * @package App\Models
 */
class SignataireIesr extends Model
{
	protected $table = 'signataire_iesrs';

	protected $casts = [
		'iesr_id' => 'int'
	];

	protected $fillable = [
		'nom',
		'prenom',
		'nip',
		'sexe',
		'typeDocument',
		'fonction',
		'fonctionLongue',
		'titreAcademique',
		'titreHonorifique',
		'iesr_id'
	];

	public function iesr()
	{
		return $this->belongsTo(Iesr::class);
	}

	public function attestation_definitives()
	{
		return $this->hasMany(AttestationDefinitive::class, 'signataireIesr_id');
	}

	public function diplomes()
	{
		return $this->hasMany(Diplome::class, 'signataireIesr_id');
	}
}
