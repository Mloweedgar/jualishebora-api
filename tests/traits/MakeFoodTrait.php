<?php

use Faker\Factory as Faker;
use App\Models\Food;
use App\Repositories\FoodRepository;

trait MakeFoodTrait
{
    /**
     * Create fake instance of Food and save it in database
     *
     * @param array $foodFields
     * @return Food
     */
    public function makeFood($foodFields = [])
    {
        /** @var FoodRepository $foodRepo */
        $foodRepo = App::make(FoodRepository::class);
        $theme = $this->fakeFoodData($foodFields);
        return $foodRepo->create($theme);
    }

    /**
     * Get fake instance of Food
     *
     * @param array $foodFields
     * @return Food
     */
    public function fakeFood($foodFields = [])
    {
        return new Food($this->fakeFoodData($foodFields));
    }

    /**
     * Get fake data of Food
     *
     * @param array $postFields
     * @return array
     */
    public function fakeFoodData($foodFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'food_type' => $fake->word,
            'teacher_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $foodFields);
    }
}
