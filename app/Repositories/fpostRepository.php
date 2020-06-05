<?php

namespace App\Repositories;

use App\Models\fpost;
use App\Repositories\BaseRepository;

/**
 * Class fpostRepository
 * @package App\Repositories
 * @version June 4, 2020, 12:22 am UTC
*/

class fpostRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'body',
        'locked',
        'fdiscusion_id',
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
        return fpost::class;
    }
}
