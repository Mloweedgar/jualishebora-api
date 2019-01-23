<?php

use Faker\Factory as Faker;
use App\Models\audio;
use App\Repositories\audioRepository;

trait MakeaudioTrait
{
    /**
     * Create fake instance of audio and save it in database
     *
     * @param array $audioFields
     * @return audio
     */
    public function makeaudio($audioFields = [])
    {
        /** @var audioRepository $audioRepo */
        $audioRepo = App::make(audioRepository::class);
        $theme = $this->fakeaudioData($audioFields);
        return $audioRepo->create($theme);
    }

    /**
     * Get fake instance of audio
     *
     * @param array $audioFields
     * @return audio
     */
    public function fakeaudio($audioFields = [])
    {
        return new audio($this->fakeaudioData($audioFields));
    }

    /**
     * Get fake data of audio
     *
     * @param array $postFields
     * @return array
     */
    public function fakeaudioData($audioFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'audio_url' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $audioFields);
    }
}
