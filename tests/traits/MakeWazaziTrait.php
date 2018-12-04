<?php

use Faker\Factory as Faker;
use App\Models\Wazazi;
use App\Repositories\WazaziRepository;

trait MakeWazaziTrait
{
    /**
     * Create fake instance of Wazazi and save it in database
     *
     * @param array $wazaziFields
     * @return Wazazi
     */
    public function makeWazazi($wazaziFields = [])
    {
        /** @var WazaziRepository $wazaziRepo */
        $wazaziRepo = App::make(WazaziRepository::class);
        $theme = $this->fakeWazaziData($wazaziFields);
        return $wazaziRepo->create($theme);
    }

    /**
     * Get fake instance of Wazazi
     *
     * @param array $wazaziFields
     * @return Wazazi
     */
    public function fakeWazazi($wazaziFields = [])
    {
        return new Wazazi($this->fakeWazaziData($wazaziFields));
    }

    /**
     * Get fake data of Wazazi
     *
     * @param array $postFields
     * @return array
     */
    public function fakeWazaziData($wazaziFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'childs_id' => $fake->randomDigitNotNull,
            'phone_number' => $fake->word,
            'first_name' => $fake->word,
            'middle_name' => $fake->word,
            'last_name' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $wazaziFields);
    }
}
