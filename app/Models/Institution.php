<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Institution
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
 * @property int $parent
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Institution $parent
 * @property Collection|Parcour[] $parcours
 * @property Collection|Signataire[] $signataires
 * @property Collection|TimbreInstitution[] $timbres
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Institution extends Model
{
    protected $table = 'institutions';

	protected $casts = [
		'parent_id' => 'int'
	];

	protected $fillable = [
		'sigle',
		'denomination',
		'telephone',
		'adresse',
		'email',
		'type',
		'logo',
		'siteWeb',
		'description',
		'parent_id'
	];

	public function parent()
	{
		return $this->belongsTo($this::class, 'parent_id');
	}

	public function parcours()
	{
		return $this->hasMany(Parcours::class);
	}

	public function signataires()
	{
		return $this->hasMany(Signataire::class);
	}

	public function timbres()
	{
		return $this->hasMany(Timbre::class);
	}

	public function users()
	{
		return $this->hasMany(User::class);
	}

	public function impetrants()
	{
		return $this->belongsToMany(Impetrant::class, 'institutions_impetrants', 'institution_id', 'impetrant_id');
	}

	
	
}
