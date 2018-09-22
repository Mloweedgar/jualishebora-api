<?php

namespace App\Transformers;

use App\Models\Image;
use League\Fractal;

class ImageTransFormer extends Fractal\TransformerAbstract
{



    public function transform( Image $image)
    {

        return [
            'url' => $image->image_url
        ];

    }

}