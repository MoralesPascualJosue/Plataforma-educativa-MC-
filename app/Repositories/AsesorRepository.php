<?php

namespace App\Repositories;

use App\Models\Asesor;
use App\Repositories\BaseRepository;

/**
 * Class AsesorRepository
 * @package App\Repositories
 * @version April 4, 2020, 9:40 pm UTC
*/

class AsesorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'image',
        'bio'
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
        return Asesor::class;
    }
}
