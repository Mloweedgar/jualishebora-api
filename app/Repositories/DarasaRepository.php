<?php

namespace App\Repositories;

use App\Models\Darasa;
use InfyOm\Generator\Common\BaseRepository;

class DarasaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'childs_age',
        'teacher_id',
        'topic_id',
        'parent_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Darasa::class;
    }
}
