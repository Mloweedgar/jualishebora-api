<?php

use Faker\Factory as Faker;
use App\Models\Products;
use App\Repositories\ProductsRepository;

trait MakeProductsTrait
{
    /**
     * Create fake instance of Products and save it in database
     *
     * @param array $productsFields
     * @return Products
     */
    public function makeProducts($productsFields = [])
    {
        /** @var ProductsRepository $productsRepo */
        $productsRepo = App::make(ProductsRepository::class);
        $theme = $this->fakeProductsData($productsFields);
        return $productsRepo->create($theme);
    }

    /**
     * Get fake instance of Products
     *
     * @param array $productsFields
     * @return Products
     */
    public function fakeProducts($productsFields = [])
    {
        return new Products($this->fakeProductsData($productsFields));
    }

    /**
     * Get fake data of Products
     *
     * @param array $postFields
     * @return array
     */
    public function fakeProductsData($productsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'price' => $fake->word,
            'image_id' => $fake->randomDigitNotNull,
            'topic_category_id' => $fake->randomDigitNotNull,
            'teacher_id' => $fake->randomDigitNotNull,
            'status' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $productsFields);
    }
}
