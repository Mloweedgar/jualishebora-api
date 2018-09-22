<?php

namespace App\Transformers;

use App\Models\Product;
use League\Fractal;

class ProductTransformer extends Fractal\TransformerAbstract
{

    protected $defaultIncludes = [
        'image'
    ];


    public function transform( Product $product)
    {

        return [
            'id' => (int) $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'status' => $product->status,
            'created_at' => $product->created_at->toDateTimeString(),
        ];

    }

    public function includeImage(Product $product)
    {
        $image = $product->image;

        return $this->item($image, new ImageTransFormer());
    }

}