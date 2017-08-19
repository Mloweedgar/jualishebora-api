<?php

use App\Models\TopicCategory;
use App\Repositories\TopicCategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TopicCategoryRepositoryTest extends TestCase
{
    use MakeTopicCategoryTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TopicCategoryRepository
     */
    protected $topicCategoryRepo;

    public function setUp()
    {
        parent::setUp();
        $this->topicCategoryRepo = App::make(TopicCategoryRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateTopicCategory()
    {
        $topicCategory = $this->fakeTopicCategoryData();
        $createdTopicCategory = $this->topicCategoryRepo->create($topicCategory);
        $createdTopicCategory = $createdTopicCategory->toArray();
        $this->assertArrayHasKey('id', $createdTopicCategory);
        $this->assertNotNull($createdTopicCategory['id'], 'Created TopicCategory must have id specified');
        $this->assertNotNull(TopicCategory::find($createdTopicCategory['id']), 'TopicCategory with given id must be in DB');
        $this->assertModelData($topicCategory, $createdTopicCategory);
    }

    /**
     * @test read
     */
    public function testReadTopicCategory()
    {
        $topicCategory = $this->makeTopicCategory();
        $dbTopicCategory = $this->topicCategoryRepo->find($topicCategory->id);
        $dbTopicCategory = $dbTopicCategory->toArray();
        $this->assertModelData($topicCategory->toArray(), $dbTopicCategory);
    }

    /**
     * @test update
     */
    public function testUpdateTopicCategory()
    {
        $topicCategory = $this->makeTopicCategory();
        $fakeTopicCategory = $this->fakeTopicCategoryData();
        $updatedTopicCategory = $this->topicCategoryRepo->update($fakeTopicCategory, $topicCategory->id);
        $this->assertModelData($fakeTopicCategory, $updatedTopicCategory->toArray());
        $dbTopicCategory = $this->topicCategoryRepo->find($topicCategory->id);
        $this->assertModelData($fakeTopicCategory, $dbTopicCategory->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteTopicCategory()
    {
        $topicCategory = $this->makeTopicCategory();
        $resp = $this->topicCategoryRepo->delete($topicCategory->id);
        $this->assertTrue($resp);
        $this->assertNull(TopicCategory::find($topicCategory->id), 'TopicCategory should not exist in DB');
    }
}
