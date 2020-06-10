<?php

use Faker\Generator as Faker;

$factory->define(App\Faq::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(100) . ' ?',
        'slug' => str_slug($faker->realText(35)),
        'answer' => $faker->paragraph(16),
        'program_type_id' => $faker->randomElement([1,2,3,4])
    ];
});
