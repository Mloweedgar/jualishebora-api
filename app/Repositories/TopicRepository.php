<?php

namespace App\Repositories;

use App\Models\Topic;
use InfyOm\Generator\Common\BaseRepository;

class TopicRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'body',
        'teacher_id',
        'food_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Topic::class;
    }
}
