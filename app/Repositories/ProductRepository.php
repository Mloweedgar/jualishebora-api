<?php

namespace App\Repositories;

use App\Models\Product;
use InfyOm\Generator\Common\BaseRepository;

class ProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'price',
        'teacher_id',
        'image_id',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Product::class;
    }
}
