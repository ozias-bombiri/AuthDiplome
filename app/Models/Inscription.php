<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Inscription
 * 
 *
 * @package App\Models
 */
class Inscription extends Model
{
	protected $table = 'inscriptions';

	protected $casts = [
		'parcours_id' => 'int',
		'etudiant_id' => 'int',
		'user_id' => 'int',
		'anneeAcademique_id' => 'int',
	];

	protected $fillable = [
		'etudiant_id',
		'parcours_id',
		'referenceInscription',
		'anneeAcademique_id',
		'user_id',
	];

	public function parcours()
	{
		return $this->belongsTo(Parcours::class, 'parcours_id');
	}

	public function anneeAcademique()
	{
		return $this->belongsTo(AnneeAcademique::class, 'anneeAcademique_id');
	}

	public function etudiant()
	{
		return $this->belongsTo(Etudiant::class);
	}

	public function moyenne($inscription_id)
	{
		
		$data = ResultatAcademique::where('inscription_id', $inscription_id)->get()->first();

		if($data != null){
			$resultat = $data->moyenne;
		}else{
			$resultat = "";
		}

		return $resultat;
	}
}
