<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PasswordRessetApiTest extends TestCase
{
    use MakePasswordRessetTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePasswordResset()
    {
        $passwordResset = $this->fakePasswordRessetData();
        $this->json('POST', '/api/v1/passwordRessets', $passwordResset);

        $this->assertApiResponse($passwordResset);
    }

    /**
     * @test
     */
    public function testReadPasswordResset()
    {
        $passwordResset = $this->makePasswordResset();
        $this->json('GET', '/api/v1/passwordRessets/'.$passwordResset->id);

        $this->assertApiResponse($passwordResset->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePasswordResset()
    {
        $passwordResset = $this->makePasswordResset();
        $editedPasswordResset = $this->fakePasswordRessetData();

        $this->json('PUT', '/api/v1/passwordRessets/'.$passwordResset->id, $editedPasswordResset);

        $this->assertApiResponse($editedPasswordResset);
    }

    /**
     * @test
     */
    public function testDeletePasswordResset()
    {
        $passwordResset = $this->makePasswordResset();
        $this->json('DELETE', '/api/v1/passwordRessets/'.$passwordResset->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/passwordRessets/'.$passwordResset->id);

        $this->assertResponseStatus(404);
    }
}
