<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TopicApiTest extends TestCase
{
    use MakeTopicTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateTopic()
    {
        $topic = $this->fakeTopicData();
        $this->json('POST', '/api/v1/topics', $topic);

        $this->assertApiResponse($topic);
    }

    /**
     * @test
     */
    public function testReadTopic()
    {
        $topic = $this->makeTopic();
        $this->json('GET', '/api/v1/topics/'.$topic->id);

        $this->assertApiResponse($topic->toArray());
    }

    /**
     * @test
     */
    public function testUpdateTopic()
    {
        $topic = $this->makeTopic();
        $editedTopic = $this->fakeTopicData();

        $this->json('PUT', '/api/v1/topics/'.$topic->id, $editedTopic);

        $this->assertApiResponse($editedTopic);
    }

    /**
     * @test
     */
    public function testDeleteTopic()
    {
        $topic = $this->makeTopic();
        $this->json('DELETE', '/api/v1/topics/'.$topic->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/topics/'.$topic->id);

        $this->assertResponseStatus(404);
    }
}
