<?php

use Faker\Factory as Faker;
use App\Models\productsCategory;
use App\Repositories\productsCategoryRepository;

trait MakeproductsCategoryTrait
{
    /**
     * Create fake instance of productsCategory and save it in database
     *
     * @param array $productsCategoryFields
     * @return productsCategory
     */
    public function makeproductsCategory($productsCategoryFields = [])
    {
        /** @var productsCategoryRepository $productsCategoryRepo */
        $productsCategoryRepo = App::make(productsCategoryRepository::class);
        $theme = $this->fakeproductsCategoryData($productsCategoryFields);
        return $productsCategoryRepo->create($theme);
    }

    /**
     * Get fake instance of productsCategory
     *
     * @param array $productsCategoryFields
     * @return productsCategory
     */
    public function fakeproductsCategory($productsCategoryFields = [])
    {
        return new productsCategory($this->fakeproductsCategoryData($productsCategoryFields));
    }

    /**
     * Get fake data of productsCategory
     *
     * @param array $postFields
     * @return array
     */
    public function fakeproductsCategoryData($productsCategoryFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $productsCategoryFields);
    }
}
