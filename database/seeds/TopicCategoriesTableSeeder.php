<?php

use Illuminate\Database\Seeder;

class TopicCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Models\TopicCategory::class,5)->create();
    }
}
