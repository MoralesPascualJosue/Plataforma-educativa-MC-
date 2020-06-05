<?php

namespace App\Repositories;

use App\Models\fcategoria;
use App\Repositories\BaseRepository;

/**
 * Class fcategoriaRepository
 * @package App\Repositories
 * @version June 3, 2020, 11:41 pm UTC
*/

class fcategoriaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'color'
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
        return fcategoria::class;
    }
}
