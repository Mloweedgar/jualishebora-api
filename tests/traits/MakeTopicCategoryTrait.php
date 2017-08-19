<?php

use Faker\Factory as Faker;
use App\Models\TopicCategory;
use App\Repositories\TopicCategoryRepository;

trait MakeTopicCategoryTrait
{
    /**
     * Create fake instance of TopicCategory and save it in database
     *
     * @param array $topicCategoryFields
     * @return TopicCategory
     */
    public function makeTopicCategory($topicCategoryFields = [])
    {
        /** @var TopicCategoryRepository $topicCategoryRepo */
        $topicCategoryRepo = App::make(TopicCategoryRepository::class);
        $theme = $this->fakeTopicCategoryData($topicCategoryFields);
        return $topicCategoryRepo->create($theme);
    }

    /**
     * Get fake instance of TopicCategory
     *
     * @param array $topicCategoryFields
     * @return TopicCategory
     */
    public function fakeTopicCategory($topicCategoryFields = [])
    {
        return new TopicCategory($this->fakeTopicCategoryData($topicCategoryFields));
    }

    /**
     * Get fake data of TopicCategory
     *
     * @param array $postFields
     * @return array
     */
    public function fakeTopicCategoryData($topicCategoryFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $topicCategoryFields);
    }
}
