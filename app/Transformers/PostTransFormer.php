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
            'body' => $post->body,
            'video_url' => $post->video_url,
            'audio_url' => $post->audio_url,
            'created_at' => $post->created_at->toDateTimeString(),
        ];

    }

    public function includeImage(Post $post)
    {
        $image = $post->image;

        return $this->item($image, new ImageTransFormer());
    }

}