<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Iesr
 * 
 * @property int $id
 * @property string $sigle
 * @property string $denomination
 * @property string $telephone
 * @property string $email
 * @property string $adresse
 * @property string|null $siteweb
 * @property string|null $logo
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Etablissement[] $etablissements
 * @property Collection|SignataireIesr[] $signataire_iesrs
 * @property Collection|TimbresIesr[] $timbres_iesrs
 *
 * @package App\Models
 */
class Iesr extends Model
{
	protected $table = 'iesrs';

	protected $fillable = [
		'sigle',
		'denomination',
		'telephone',
		'email',
		'adresse',
		'siteweb',
		'logo',
		'description'
	];

	public function etablissements()
	{
		return $this->hasMany(Etablissement::class);
	}

	public function signataire_iesrs()
	{
		return $this->hasMany(SignataireIesr::class);
	}

	public function timbres_iesrs()
	{
		return $this->hasMany(TimbresIesr::class);
	}
}
