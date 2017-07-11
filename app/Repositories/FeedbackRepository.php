<?php

namespace App\Repositories;

use App\Models\Feedback;
use InfyOm\Generator\Common\BaseRepository;

class FeedbackRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'body',
        'darasa_id',
        'parent_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Feedback::class;
    }
}
