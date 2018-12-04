<?php

use App\Models\PasswordResset;
use App\Repositories\PasswordRessetRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PasswordRessetRepositoryTest extends TestCase
{
    use MakePasswordRessetTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PasswordRessetRepository
     */
    protected $passwordRessetRepo;

    public function setUp()
    {
        parent::setUp();
        $this->passwordRessetRepo = App::make(PasswordRessetRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePasswordResset()
    {
        $passwordResset = $this->fakePasswordRessetData();
        $createdPasswordResset = $this->passwordRessetRepo->create($passwordResset);
        $createdPasswordResset = $createdPasswordResset->toArray();
        $this->assertArrayHasKey('id', $createdPasswordResset);
        $this->assertNotNull($createdPasswordResset['id'], 'Created PasswordResset must have id specified');
        $this->assertNotNull(PasswordResset::find($createdPasswordResset['id']), 'PasswordResset with given id must be in DB');
        $this->assertModelData($passwordResset, $createdPasswordResset);
    }

    /**
     * @test read
     */
    public function testReadPasswordResset()
    {
        $passwordResset = $this->makePasswordResset();
        $dbPasswordResset = $this->passwordRessetRepo->find($passwordResset->id);
        $dbPasswordResset = $dbPasswordResset->toArray();
        $this->assertModelData($passwordResset->toArray(), $dbPasswordResset);
    }

    /**
     * @test update
     */
    public function testUpdatePasswordResset()
    {
        $passwordResset = $this->makePasswordResset();
        $fakePasswordResset = $this->fakePasswordRessetData();
        $updatedPasswordResset = $this->passwordRessetRepo->update($fakePasswordResset, $passwordResset->id);
        $this->assertModelData($fakePasswordResset, $updatedPasswordResset->toArray());
        $dbPasswordResset = $this->passwordRessetRepo->find($passwordResset->id);
        $this->assertModelData($fakePasswordResset, $dbPasswordResset->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePasswordResset()
    {
        $passwordResset = $this->makePasswordResset();
        $resp = $this->passwordRessetRepo->delete($passwordResset->id);
        $this->assertTrue($resp);
        $this->assertNull(PasswordResset::find($passwordResset->id), 'PasswordResset should not exist in DB');
    }
}
