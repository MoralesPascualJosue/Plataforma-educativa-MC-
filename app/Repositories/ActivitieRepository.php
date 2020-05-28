<?php

namespace App\Repositories;

use App\Models\Activitie;
use App\Repositories\BaseRepository;

/**
 * Class ActivitieRepository
 * @package App\Repositories
 * @version May 27, 2020, 8:47 pm UTC
*/

class ActivitieRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'visible',
        'intentos',
        'fecha_inicio',
        'fecha_final'
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
        return Activitie::class;
    }
}
