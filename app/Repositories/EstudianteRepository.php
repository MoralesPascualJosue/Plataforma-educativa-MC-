<?php

namespace App\Repositories;

use App\Models\Estudiante;
use App\Repositories\BaseRepository;

/**
 * Class EstudianteRepository
 * @package App\Repositories
 * @version May 25, 2020, 7:42 pm UTC
*/

class EstudianteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'bio',
        'image',
        'institute',
        'department',
        'telephone',
        'user_id'
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
        return Estudiante::class;
    }

     public function findestudiantescalificacion( $estudiante,$activiad,$columns = ['*'])
    {
        $query = $this->model->newQuery();

        return $query->select($columns)->where("id","=", $estudiante);
    }
}
