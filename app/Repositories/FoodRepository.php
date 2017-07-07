<?php

namespace App\Repositories;

use App\Models\Food;
use InfyOm\Generator\Common\BaseRepository;

class FoodRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'food_type',
        'teacher_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Food::class;
    }
}
