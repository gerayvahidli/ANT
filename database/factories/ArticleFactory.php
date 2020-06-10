<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(100),
        'slug' => str_slug($faker->realText(30)),
        'body' => $faker->paragraph,
        'published_at' => $faker->dateTime(),
        'program_type_id' => $faker->randomElement([1,2,3,4])
    ];
});
