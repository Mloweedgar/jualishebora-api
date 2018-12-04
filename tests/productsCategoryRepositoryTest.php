<?php

use App\Models\productsCategory;
use App\Repositories\productsCategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class productsCategoryRepositoryTest extends TestCase
{
    use MakeproductsCategoryTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var productsCategoryRepository
     */
    protected $productsCategoryRepo;

    public function setUp()
    {
        parent::setUp();
        $this->productsCategoryRepo = App::make(productsCategoryRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateproductsCategory()
    {
        $productsCategory = $this->fakeproductsCategoryData();
        $createdproductsCategory = $this->productsCategoryRepo->create($productsCategory);
        $createdproductsCategory = $createdproductsCategory->toArray();
        $this->assertArrayHasKey('id', $createdproductsCategory);
        $this->assertNotNull($createdproductsCategory['id'], 'Created productsCategory must have id specified');
        $this->assertNotNull(productsCategory::find($createdproductsCategory['id']), 'productsCategory with given id must be in DB');
        $this->assertModelData($productsCategory, $createdproductsCategory);
    }

    /**
     * @test read
     */
    public function testReadproductsCategory()
    {
        $productsCategory = $this->makeproductsCategory();
        $dbproductsCategory = $this->productsCategoryRepo->find($productsCategory->id);
        $dbproductsCategory = $dbproductsCategory->toArray();
        $this->assertModelData($productsCategory->toArray(), $dbproductsCategory);
    }

    /**
     * @test update
     */
    public function testUpdateproductsCategory()
    {
        $productsCategory = $this->makeproductsCategory();
        $fakeproductsCategory = $this->fakeproductsCategoryData();
        $updatedproductsCategory = $this->productsCategoryRepo->update($fakeproductsCategory, $productsCategory->id);
        $this->assertModelData($fakeproductsCategory, $updatedproductsCategory->toArray());
        $dbproductsCategory = $this->productsCategoryRepo->find($productsCategory->id);
        $this->assertModelData($fakeproductsCategory, $dbproductsCategory->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteproductsCategory()
    {
        $productsCategory = $this->makeproductsCategory();
        $resp = $this->productsCategoryRepo->delete($productsCategory->id);
        $this->assertTrue($resp);
        $this->assertNull(productsCategory::find($productsCategory->id), 'productsCategory should not exist in DB');
    }
}
