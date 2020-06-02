<?php

namespace App\Repositories;

use App\Models\Qualification;
use App\Repositories\BaseRepository;

/**
 * Class QualificationRepository
 * @package App\Repositories
 * @version June 1, 2020, 6:17 am UTC
*/

class QualificationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'qualification',
        'observaciones',
        'estado',
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
        return Qualification::class;
    }
}
