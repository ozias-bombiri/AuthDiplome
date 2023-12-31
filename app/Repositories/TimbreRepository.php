<?php

namespace App\Repositories;

use App\Models\Timbre;
use App\Repositories\BaseRepository;

/**
 * Class TimbreRepository
 * @package App\Repositories
 * @version April 9, 2022, 9:37 am UTC
*/

class TimbreRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'intitule',
		'type',
		'ministere',
		'denomMinistere',
		'description',
		'institution_id'
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
        return Timbre::class;
    }

    /**
     * FindByIntitution and type
     **/
    public function findByInstitutionAndType($institution_id, $type)
    {
       $timbre = Timbre::where('institution_id', '=', $institution_id)
                        ->where('type', '=', $type)
                        ->first();
        return $timbre;
    }

    /**
     * FindByIntitution and type
     **/
    public function findByEtablissement($institution_id)
    {
       $timbres = Timbre::where('institution_id', '=', $institution_id)
                        ->get();
        return $timbres;
    }

    /**
     * FindByIntitution and type
     **/
    public function findByIesr($iesr_id)
    {
       $timbres = Timbre::join('institutions', 'timbres.institution_id', '=', 'institution.id')
                        ->where('institutions.parent_id', '=', $iesr_id)
                        ->get();
        return $timbres;
    }
}
