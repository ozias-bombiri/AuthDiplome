<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProcesVerbal
 * 
 * @package App\Models
 */
class ProcesVerbal extends Model
{
    protected $table = 'proces_verbaux';

	protected $casts = [
		'parcours_id' => 'int',
		'anneeAcademique_id' => 'int',
		'nombreEtudiants' => 'int',
		'user_id' => 'int',
		
	];

	protected $fillable = [
		'reference',
		'nomFichierPdf',
		'nombreEtudiants',
		'dateDeliberation',
		'session',
		'description',
		'parcours_id',
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

	public function resultat_academiques()
	{
		return $this->hasMany(ResultatAcademique::class);
	}

	public function actesEnregistres($procesVerbal_id, $intitule)
	{
		$categorieActe = CategorieActe::where('intitule', 'like', '%'.$intitule.'%')->first() ;

		$actes = ResultatAcademique::join('proces_verbaux', 'resultat_academiques.procesVerbal_id', '=', 'proces_verbaux.id')
					->join('acte_academiques', 'acte_academiques.resultatAcademique_id', '=', 'resultat_academiques.id')
					->where('proces_verbaux.id', $procesVerbal_id)
					->where('acte_academiques.categorieActe_id', $categorieActe->id)
					->select('acte_academiques.*')
					->get();
		if ($actes->isEmpty()) return false ;

		return true ;
	
	}

	
}
