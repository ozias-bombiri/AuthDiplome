<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DemandeAuthentification
 * 
 * @property int $id
 * @property string $reference
 * @property string $reponse
 * @property Carbon $dateDemande
 * @property string $demandeur
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * 
 * @package App\Models
 */
class DemandeAuthentification extends Model
{
	protected $table = 'demande_authentifications';

	protected $casts = [
		'dateDemande' => 'datetime',
		
	];

	protected $fillable = [
		'reference',
		'reponse',
		'dateDemande',
		'demandeur',
		'description',
	];

	
}
