<?php

namespace App\Repositories;

use App\Models\productsCategory;
use InfyOm\Generator\Common\BaseRepository;

class productsCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return productsCategory::class;
    }
}
