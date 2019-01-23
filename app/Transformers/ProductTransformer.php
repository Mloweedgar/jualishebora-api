<?php

namespace App\Transformers;

//use App\Models\Products;
use League\Fractal;
use App\Models\Products;

class ProductTransformer extends Fractal\TransformerAbstract
{

    protected $defaultIncludes = [
        'image'
    ];

    /**
     *  @param Products $product
     * 
     * 
     */
   


    public function transform(Products $product)
    {

        return [
            'id' => (int) $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'status' => $product->status,
            'created_at' => $product->created_at->toDateTimeString(),
        ];

    }

    public function includeImage(Products $product)
    {
        $image = $product->image;

        return $this->item($image, new ImageTransFormer());
    }

}