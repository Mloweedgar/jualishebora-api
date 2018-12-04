<?php

use Faker\Factory as Faker;
use App\Models\Darasa;
use App\Repositories\DarasaRepository;

trait MakeDarasaTrait
{
    /**
     * Create fake instance of Darasa and save it in database
     *
     * @param array $darasaFields
     * @return Darasa
     */
    public function makeDarasa($darasaFields = [])
    {
        /** @var DarasaRepository $darasaRepo */
        $darasaRepo = App::make(DarasaRepository::class);
        $theme = $this->fakeDarasaData($darasaFields);
        return $darasaRepo->create($theme);
    }

    /**
     * Get fake instance of Darasa
     *
     * @param array $darasaFields
     * @return Darasa
     */
    public function fakeDarasa($darasaFields = [])
    {
        return new Darasa($this->fakeDarasaData($darasaFields));
    }

    /**
     * Get fake data of Darasa
     *
     * @param array $postFields
     * @return array
     */
    public function fakeDarasaData($darasaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'childs_age' => $fake->randomDigitNotNull,
            'teacher_id' => $fake->randomDigitNotNull,
            'topic_id' => $fake->randomDigitNotNull,
            'parent_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $darasaFields);
    }
}
