<?php

namespace App\Repositories;

use App\Models\TopicCategory;
use InfyOm\Generator\Common\BaseRepository;

class TopicCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return TopicCategory::class;
    }
}
