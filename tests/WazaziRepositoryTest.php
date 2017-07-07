<?php

use App\Models\Wazazi;
use App\Repositories\WazaziRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WazaziRepositoryTest extends TestCase
{
    use MakeWazaziTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var WazaziRepository
     */
    protected $wazaziRepo;

    public function setUp()
    {
        parent::setUp();
        $this->wazaziRepo = App::make(WazaziRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateWazazi()
    {
        $wazazi = $this->fakeWazaziData();
        $createdWazazi = $this->wazaziRepo->create($wazazi);
        $createdWazazi = $createdWazazi->toArray();
        $this->assertArrayHasKey('id', $createdWazazi);
        $this->assertNotNull($createdWazazi['id'], 'Created Wazazi must have id specified');
        $this->assertNotNull(Wazazi::find($createdWazazi['id']), 'Wazazi with given id must be in DB');
        $this->assertModelData($wazazi, $createdWazazi);
    }

    /**
     * @test read
     */
    public function testReadWazazi()
    {
        $wazazi = $this->makeWazazi();
        $dbWazazi = $this->wazaziRepo->find($wazazi->id);
        $dbWazazi = $dbWazazi->toArray();
        $this->assertModelData($wazazi->toArray(), $dbWazazi);
    }

    /**
     * @test update
     */
    public function testUpdateWazazi()
    {
        $wazazi = $this->makeWazazi();
        $fakeWazazi = $this->fakeWazaziData();
        $updatedWazazi = $this->wazaziRepo->update($fakeWazazi, $wazazi->id);
        $this->assertModelData($fakeWazazi, $updatedWazazi->toArray());
        $dbWazazi = $this->wazaziRepo->find($wazazi->id);
        $this->assertModelData($fakeWazazi, $dbWazazi->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteWazazi()
    {
        $wazazi = $this->makeWazazi();
        $resp = $this->wazaziRepo->delete($wazazi->id);
        $this->assertTrue($resp);
        $this->assertNull(Wazazi::find($wazazi->id), 'Wazazi should not exist in DB');
    }
}
