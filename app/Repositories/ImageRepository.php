<?php

namespace App\Repositories;

use App\Models\Image;
use InfyOm\Generator\Common\BaseRepository;

class ImageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'image_url',
        'teacher_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Image::class;
    }
}
