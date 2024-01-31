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
 * Class Institution * 
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
		'code',
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
		return $this->belongsTo(Institution::class, 'parent_id');
	}

	public function etablissements()
	{
		return $this->hasMany(Institution::class, 'parent_id');
	}

	public function filieres()
	{
		return $this->hasMany(Filiere::class);
	}

	public function signataireActes()
	{
		return $this->belongsToMany(SignataireActe::class);
	}

	public function timbres()
	{
		return $this->hasMany(Timbre::class,);
	}

	public function visaInstitutions()
	{
		return $this->hasMany(VisaInstitution::class);
	}

	public function users()
	{
		return $this->hasMany(User::class);
	}
	
	public function numeroteurs()
	{
		return $this->hasMany(Numeroteur::class);
	}
	
}
