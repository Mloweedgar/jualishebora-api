<?php

use Faker\Factory as Faker;
use App\Models\PasswordResset;
use App\Repositories\PasswordRessetRepository;

trait MakePasswordRessetTrait
{
    /**
     * Create fake instance of PasswordResset and save it in database
     *
     * @param array $passwordRessetFields
     * @return PasswordResset
     */
    public function makePasswordResset($passwordRessetFields = [])
    {
        /** @var PasswordRessetRepository $passwordRessetRepo */
        $passwordRessetRepo = App::make(PasswordRessetRepository::class);
        $theme = $this->fakePasswordRessetData($passwordRessetFields);
        return $passwordRessetRepo->create($theme);
    }

    /**
     * Get fake instance of PasswordResset
     *
     * @param array $passwordRessetFields
     * @return PasswordResset
     */
    public function fakePasswordResset($passwordRessetFields = [])
    {
        return new PasswordResset($this->fakePasswordRessetData($passwordRessetFields));
    }

    /**
     * Get fake data of PasswordResset
     *
     * @param array $postFields
     * @return array
     */
    public function fakePasswordRessetData($passwordRessetFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'email' => $fake->word,
            'token' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $passwordRessetFields);
    }
}
