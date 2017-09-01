<?php

use Faker\Factory as Faker;
use App\Models\Image;
use App\Repositories\ImageRepository;

trait MakeImageTrait
{
    /**
     * Create fake instance of Image and save it in database
     *
     * @param array $imageFields
     * @return Image
     */
    public function makeImage($imageFields = [])
    {
        /** @var ImageRepository $imageRepo */
        $imageRepo = App::make(ImageRepository::class);
        $theme = $this->fakeImageData($imageFields);
        return $imageRepo->create($theme);
    }

    /**
     * Get fake instance of Image
     *
     * @param array $imageFields
     * @return Image
     */
    public function fakeImage($imageFields = [])
    {
        return new Image($this->fakeImageData($imageFields));
    }

    /**
     * Get fake data of Image
     *
     * @param array $postFields
     * @return array
     */
    public function fakeImageData($imageFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'image_url' => $fake->word,
            'teacher_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $imageFields);
    }
}
