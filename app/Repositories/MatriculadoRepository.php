<?php

namespace App\Repositories;

use App\Models\Matriculado;
use App\Repositories\BaseRepository;

/**
 * Class MatriculadoRepository
 * @package App\Repositories
 * @version May 26, 2020, 3:55 pm UTC
*/

class MatriculadoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'estudiante_id',
        'curso_id'
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
        return Matriculado::class;
    }
}
