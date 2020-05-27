<?php

namespace App\Repositories;

use App\Models\curso;
use App\Repositories\BaseRepository;

/**
 * Class cursoRepository
 * @package App\Repositories
 * @version April 9, 2020, 4:16 pm UTC
*/

class cursoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'review',
        'cover',
        'asesor_id'
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
        return curso::class;
    }
}
