<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TopicCategoryApiTest extends TestCase
{
    use MakeTopicCategoryTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateTopicCategory()
    {
        $topicCategory = $this->fakeTopicCategoryData();
        $this->json('POST', '/api/v1/topicCategories', $topicCategory);

        $this->assertApiResponse($topicCategory);
    }

    /**
     * @test
     */
    public function testReadTopicCategory()
    {
        $topicCategory = $this->makeTopicCategory();
        $this->json('GET', '/api/v1/topicCategories/'.$topicCategory->id);

        $this->assertApiResponse($topicCategory->toArray());
    }

    /**
     * @test
     */
    public function testUpdateTopicCategory()
    {
        $topicCategory = $this->makeTopicCategory();
        $editedTopicCategory = $this->fakeTopicCategoryData();

        $this->json('PUT', '/api/v1/topicCategories/'.$topicCategory->id, $editedTopicCategory);

        $this->assertApiResponse($editedTopicCategory);
    }

    /**
     * @test
     */
    public function testDeleteTopicCategory()
    {
        $topicCategory = $this->makeTopicCategory();
        $this->json('DELETE', '/api/v1/topicCategories/'.$topicCategory->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/topicCategories/'.$topicCategory->id);

        $this->assertResponseStatus(404);
    }
}
