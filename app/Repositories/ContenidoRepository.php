<?php

namespace App\Repositories;

use App\Models\Contenido;
use App\Repositories\BaseRepository;

/**
 * Class ContenidoRepository
 * @package App\Repositories
 * @version May 28, 2020, 5:16 pm UTC
*/

class ContenidoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'curso_id',
        'activitie_id'
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
        return Contenido::class;
    }
}
