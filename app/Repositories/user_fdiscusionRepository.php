<?php

namespace App\Repositories;

use App\Models\user_fdiscusion;
use App\Repositories\BaseRepository;

/**
 * Class user_fdiscusionRepository
 * @package App\Repositories
 * @version June 4, 2020, 1:12 am UTC
*/

class user_fdiscusionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'fdiscusion_id'
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
        return user_fdiscusion::class;
    }
}
