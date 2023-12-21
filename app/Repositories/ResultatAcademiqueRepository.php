<?php

namespace App\Repositories;

use App\Models\ResultatAcademique;
use App\Repositories\BaseRepository;

/**
 * Class ResultatAcademiqueRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class ResultatAcademiqueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'reference',
		'moyenne',
		'inscription_id',
		'procesVerbal_id',
		'user_id',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ResultatAcademique::class;
    }


     /**
     * Selectionner par pv
     **/
    public function findByProcesVerbal($procesVerbal_id)
    {
        return ResultatAcademique::join('proces_verbaux', 'resultat_academiques.procesVerbal_id', '=', 'proces_verbaux.id')
                ->where('proces_verbaux.id', $procesVerbal_id)
                ->select('resultat_academiques.*')
                ->get();
    }
}
