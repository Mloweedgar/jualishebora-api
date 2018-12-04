<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DarasaApiTest extends TestCase
{
    use MakeDarasaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateDarasa()
    {
        $darasa = $this->fakeDarasaData();
        $this->json('POST', '/api/v1/darasas', $darasa);

        $this->assertApiResponse($darasa);
    }

    /**
     * @test
     */
    public function testReadDarasa()
    {
        $darasa = $this->makeDarasa();
        $this->json('GET', '/api/v1/darasas/'.$darasa->id);

        $this->assertApiResponse($darasa->toArray());
    }

    /**
     * @test
     */
    public function testUpdateDarasa()
    {
        $darasa = $this->makeDarasa();
        $editedDarasa = $this->fakeDarasaData();

        $this->json('PUT', '/api/v1/darasas/'.$darasa->id, $editedDarasa);

        $this->assertApiResponse($editedDarasa);
    }

    /**
     * @test
     */
    public function testDeleteDarasa()
    {
        $darasa = $this->makeDarasa();
        $this->json('DELETE', '/api/v1/darasas/'.$darasa->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/darasas/'.$darasa->id);

        $this->assertResponseStatus(404);
    }
}
