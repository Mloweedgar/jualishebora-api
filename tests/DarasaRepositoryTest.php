<?php

use App\Models\Darasa;
use App\Repositories\DarasaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DarasaRepositoryTest extends TestCase
{
    use MakeDarasaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DarasaRepository
     */
    protected $darasaRepo;

    public function setUp()
    {
        parent::setUp();
        $this->darasaRepo = App::make(DarasaRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateDarasa()
    {
        $darasa = $this->fakeDarasaData();
        $createdDarasa = $this->darasaRepo->create($darasa);
        $createdDarasa = $createdDarasa->toArray();
        $this->assertArrayHasKey('id', $createdDarasa);
        $this->assertNotNull($createdDarasa['id'], 'Created Darasa must have id specified');
        $this->assertNotNull(Darasa::find($createdDarasa['id']), 'Darasa with given id must be in DB');
        $this->assertModelData($darasa, $createdDarasa);
    }

    /**
     * @test read
     */
    public function testReadDarasa()
    {
        $darasa = $this->makeDarasa();
        $dbDarasa = $this->darasaRepo->find($darasa->id);
        $dbDarasa = $dbDarasa->toArray();
        $this->assertModelData($darasa->toArray(), $dbDarasa);
    }

    /**
     * @test update
     */
    public function testUpdateDarasa()
    {
        $darasa = $this->makeDarasa();
        $fakeDarasa = $this->fakeDarasaData();
        $updatedDarasa = $this->darasaRepo->update($fakeDarasa, $darasa->id);
        $this->assertModelData($fakeDarasa, $updatedDarasa->toArray());
        $dbDarasa = $this->darasaRepo->find($darasa->id);
        $this->assertModelData($fakeDarasa, $dbDarasa->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteDarasa()
    {
        $darasa = $this->makeDarasa();
        $resp = $this->darasaRepo->delete($darasa->id);
        $this->assertTrue($resp);
        $this->assertNull(Darasa::find($darasa->id), 'Darasa should not exist in DB');
    }
}
