<?php

use App\Models\audio;
use App\Repositories\audioRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class audioRepositoryTest extends TestCase
{
    use MakeaudioTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var audioRepository
     */
    protected $audioRepo;

    public function setUp()
    {
        parent::setUp();
        $this->audioRepo = App::make(audioRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateaudio()
    {
        $audio = $this->fakeaudioData();
        $createdaudio = $this->audioRepo->create($audio);
        $createdaudio = $createdaudio->toArray();
        $this->assertArrayHasKey('id', $createdaudio);
        $this->assertNotNull($createdaudio['id'], 'Created audio must have id specified');
        $this->assertNotNull(audio::find($createdaudio['id']), 'audio with given id must be in DB');
        $this->assertModelData($audio, $createdaudio);
    }

    /**
     * @test read
     */
    public function testReadaudio()
    {
        $audio = $this->makeaudio();
        $dbaudio = $this->audioRepo->find($audio->id);
        $dbaudio = $dbaudio->toArray();
        $this->assertModelData($audio->toArray(), $dbaudio);
    }

    /**
     * @test update
     */
    public function testUpdateaudio()
    {
        $audio = $this->makeaudio();
        $fakeaudio = $this->fakeaudioData();
        $updatedaudio = $this->audioRepo->update($fakeaudio, $audio->id);
        $this->assertModelData($fakeaudio, $updatedaudio->toArray());
        $dbaudio = $this->audioRepo->find($audio->id);
        $this->assertModelData($fakeaudio, $dbaudio->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteaudio()
    {
        $audio = $this->makeaudio();
        $resp = $this->audioRepo->delete($audio->id);
        $this->assertTrue($resp);
        $this->assertNull(audio::find($audio->id), 'audio should not exist in DB');
    }
}
