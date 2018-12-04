<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WazaziApiTest extends TestCase
{
    use MakeWazaziTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateWazazi()
    {
        $wazazi = $this->fakeWazaziData();
        $this->json('POST', '/api/v1/wazazis', $wazazi);

        $this->assertApiResponse($wazazi);
    }

    /**
     * @test
     */
    public function testReadWazazi()
    {
        $wazazi = $this->makeWazazi();
        $this->json('GET', '/api/v1/wazazis/'.$wazazi->id);

        $this->assertApiResponse($wazazi->toArray());
    }

    /**
     * @test
     */
    public function testUpdateWazazi()
    {
        $wazazi = $this->makeWazazi();
        $editedWazazi = $this->fakeWazaziData();

        $this->json('PUT', '/api/v1/wazazis/'.$wazazi->id, $editedWazazi);

        $this->assertApiResponse($editedWazazi);
    }

    /**
     * @test
     */
    public function testDeleteWazazi()
    {
        $wazazi = $this->makeWazazi();
        $this->json('DELETE', '/api/v1/wazazis/'.$wazazi->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/wazazis/'.$wazazi->id);

        $this->assertResponseStatus(404);
    }
}
