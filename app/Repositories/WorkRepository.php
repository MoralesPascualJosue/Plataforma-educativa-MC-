<?php

namespace App\Repositories;

use App\Models\Work;
use App\Repositories\BaseRepository;

/**
 * Class WorkRepository
 * @package App\Repositories
 * @version May 31, 2020, 8:25 pm UTC
*/

class WorkRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'contenido',
        'entregas',
        'activitie_id',
        'estudiante_id'
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
        return Work::class;
    }
}
