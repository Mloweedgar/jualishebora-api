<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class audioApiTest extends TestCase
{
    use MakeaudioTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateaudio()
    {
        $audio = $this->fakeaudioData();
        $this->json('POST', '/api/v1/audio', $audio);

        $this->assertApiResponse($audio);
    }

    /**
     * @test
     */
    public function testReadaudio()
    {
        $audio = $this->makeaudio();
        $this->json('GET', '/api/v1/audio/'.$audio->id);

        $this->assertApiResponse($audio->toArray());
    }

    /**
     * @test
     */
    public function testUpdateaudio()
    {
        $audio = $this->makeaudio();
        $editedaudio = $this->fakeaudioData();

        $this->json('PUT', '/api/v1/audio/'.$audio->id, $editedaudio);

        $this->assertApiResponse($editedaudio);
    }

    /**
     * @test
     */
    public function testDeleteaudio()
    {
        $audio = $this->makeaudio();
        $this->json('DELETE', '/api/v1/audio/'.$audio->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/audio/'.$audio->id);

        $this->assertResponseStatus(404);
    }
}
