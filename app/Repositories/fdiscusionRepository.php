<?php

namespace App\Repositories;

use App\Models\fdiscusion;
use App\Repositories\BaseRepository;

/**
 * Class fdiscusionRepository
 * @package App\Repositories
 * @version June 3, 2020, 11:53 pm UTC
*/

class fdiscusionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'views',
        'answered',
        'user_id',
        'curso_id',
        'fcategoria'
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
        return fdiscusion::class;
    }

}
