<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Etablissement
 * 
 * @property int $id
 * @property string $sigle
 * @property string $denomination
 * @property string $telephone
 * @property string $adresse
 * @property string $email
 * @property string $type
 * @property string $logo
 * @property string $description
 * @property int $iesr_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Iesr $iesr
 * @property Collection|Parcour[] $parcours
 * @property Collection|SignataireEtablissement[] $signataire_etablissements
 * @property Collection|TimbreEtablissement[] $timbre_etablissements
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Etablissement extends Model
{
	protected $table = 'etablissements';

	protected $casts = [
		'iesr_id' => 'int'
	];

	protected $fillable = [
		'sigle',
		'denomination',
		'telephone',
		'adresse',
		'email',
		'type',
		'logo',
		'description',
		'iesr_id'
	];

	public function iesr()
	{
		return $this->belongsTo(Iesr::class);
	}

	public function parcours()
	{
		return $this->hasMany(Parcour::class);
	}

	public function signataire_etablissements()
	{
		return $this->hasMany(SignataireEtablissement::class);
	}

	public function timbre_etablissements()
	{
		return $this->hasMany(TimbreEtablissement::class);
	}

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
