<?php

namespace App\Repositories;

use App\Models\Subscriber;
use InfyOm\Generator\Common\BaseRepository;

class SubscriberRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'phone_number',
        'teacher_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Subscriber::class;
    }
}
