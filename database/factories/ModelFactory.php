<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Teacher::class,function(Faker\Generator $faker){
            static $password;

            return [
                'first_name' => $faker->lastName,
                'middle_name' => $faker->lastName,
                'last_name' => $faker->lastName,
                'password' => $password ?: $password = bcrypt('secret'), 
            ];
});

$factory->define(App\Models\Food::class,function (Faker\Generator $faker){
            return [
                'name' => $faker->word,
                'food_type' =>$faker->word,
                'teacher_id' => function(){
                        return factory(App\Models\Teacher::class)->create()->id;
                },
            ];
});

$factory->define(App\Models\TopicCategory::class,function(Faker\Generator $faker){
    return [
        'category_name' => $faker->sentence
    ];
});


$factory->define(App\Models\Topic::class,function (Faker\Generator $faker){
            return [
                'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'body' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'teacher_id' => function(){
                    return factory(App\Models\Teacher::class)->create()->id;
                },
                'food_id' => function(){
                    return factory(App\Models\Food::class)->create()->id;
                },
                'topic_category_id' => function(){
                    return factory(App\Models\TopicCategory::class)->create()->id;
                }
            ];
});

//Generatting fake data of Image table
$factory->define(App\Models\Image::class, function (Faker\Generator $faker){
    return [
         'image_url'=>$faker->imageUrl($width = 640, $height = 480),
         'teacher_id'=>function(){
             return factory(App\Models\Teacher::class)->create()->id;
         }

    ];

});


$factory->define(App\Models\Post::class,function(Faker\Generator $faker){
    return [
        'title' => $faker->sentence,
        'body'  => $faker->text,
        'topic_id' => function(){
        return factory(App\Models\Topic::class)->create()->id;
        }
    ];
});


