<?php

namespace App\Repositories;

use App\Models\Anuncio;
use App\Repositories\BaseRepository;

/**
 * Class AnuncioRepository
 * @package App\Repositories
 * @version May 21, 2020, 6:07 pm UTC
*/

class AnuncioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'anuncio',
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
        return Anuncio::class;
    }
}
