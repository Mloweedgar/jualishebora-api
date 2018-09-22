<?php

namespace App\Transformers;

use App\Models\Post;
use League\Fractal;

class PostTransFormer extends Fractal\TransformerAbstract
{

    protected $defaultIncludes = [
        'image'
    ];


    public function transform( Post $post)
    {

        return [
            'id' => (int) $post->id,
            'title' => $post->title,
            'body' => $post->body
        ];

    }

    public function includeImage(Post $post)
    {
        $image = $post->image;

        return $this->item($image, new ImageTransFormer());
    }

}