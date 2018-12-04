<?php

use Faker\Factory as Faker;
use App\Models\Subscriber;
use App\Repositories\SubscriberRepository;

trait MakeSubscriberTrait
{
    /**
     * Create fake instance of Subscriber and save it in database
     *
     * @param array $subscriberFields
     * @return Subscriber
     */
    public function makeSubscriber($subscriberFields = [])
    {
        /** @var SubscriberRepository $subscriberRepo */
        $subscriberRepo = App::make(SubscriberRepository::class);
        $theme = $this->fakeSubscriberData($subscriberFields);
        return $subscriberRepo->create($theme);
    }

    /**
     * Get fake instance of Subscriber
     *
     * @param array $subscriberFields
     * @return Subscriber
     */
    public function fakeSubscriber($subscriberFields = [])
    {
        return new Subscriber($this->fakeSubscriberData($subscriberFields));
    }

    /**
     * Get fake data of Subscriber
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSubscriberData($subscriberFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'phone_number' => $fake->word,
            'name' => $fake->word,
            'teacher_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $subscriberFields);
    }
}
