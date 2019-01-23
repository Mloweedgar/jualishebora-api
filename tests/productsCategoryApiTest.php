<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class productsCategoryApiTest extends TestCase
{
    use MakeproductsCategoryTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateproductsCategory()
    {
        $productsCategory = $this->fakeproductsCategoryData();
        $this->json('POST', '/api/v1/productsCategories', $productsCategory);

        $this->assertApiResponse($productsCategory);
    }

    /**
     * @test
     */
    public function testReadproductsCategory()
    {
        $productsCategory = $this->makeproductsCategory();
        $this->json('GET', '/api/v1/productsCategories/'.$productsCategory->id);

        $this->assertApiResponse($productsCategory->toArray());
    }

    /**
     * @test
     */
    public function testUpdateproductsCategory()
    {
        $productsCategory = $this->makeproductsCategory();
        $editedproductsCategory = $this->fakeproductsCategoryData();

        $this->json('PUT', '/api/v1/productsCategories/'.$productsCategory->id, $editedproductsCategory);

        $this->assertApiResponse($editedproductsCategory);
    }

    /**
     * @test
     */
    public function testDeleteproductsCategory()
    {
        $productsCategory = $this->makeproductsCategory();
        $this->json('DELETE', '/api/v1/productsCategories/'.$productsCategory->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/productsCategories/'.$productsCategory->id);

        $this->assertResponseStatus(404);
    }
}
