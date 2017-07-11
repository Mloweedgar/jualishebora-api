<?php

use App\Models\Topic;
use App\Repositories\TopicRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TopicRepositoryTest extends TestCase
{
    use MakeTopicTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TopicRepository
     */
    protected $topicRepo;

    public function setUp()
    {
        parent::setUp();
        $this->topicRepo = App::make(TopicRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateTopic()
    {
        $topic = $this->fakeTopicData();
        $createdTopic = $this->topicRepo->create($topic);
        $createdTopic = $createdTopic->toArray();
        $this->assertArrayHasKey('id', $createdTopic);
        $this->assertNotNull($createdTopic['id'], 'Created Topic must have id specified');
        $this->assertNotNull(Topic::find($createdTopic['id']), 'Topic with given id must be in DB');
        $this->assertModelData($topic, $createdTopic);
    }

    /**
     * @test read
     */
    public function testReadTopic()
    {
        $topic = $this->makeTopic();
        $dbTopic = $this->topicRepo->find($topic->id);
        $dbTopic = $dbTopic->toArray();
        $this->assertModelData($topic->toArray(), $dbTopic);
    }

    /**
     * @test update
     */
    public function testUpdateTopic()
    {
        $topic = $this->makeTopic();
        $fakeTopic = $this->fakeTopicData();
        $updatedTopic = $this->topicRepo->update($fakeTopic, $topic->id);
        $this->assertModelData($fakeTopic, $updatedTopic->toArray());
        $dbTopic = $this->topicRepo->find($topic->id);
        $this->assertModelData($fakeTopic, $dbTopic->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteTopic()
    {
        $topic = $this->makeTopic();
        $resp = $this->topicRepo->delete($topic->id);
        $this->assertTrue($resp);
        $this->assertNull(Topic::find($topic->id), 'Topic should not exist in DB');
    }
}
