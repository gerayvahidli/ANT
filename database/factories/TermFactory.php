<?php

use Faker\Generator as Faker;

$factory->define(App\Term::class, function (Faker $faker) {
    $termTypes = App\TermType::pluck('id')->toArray();
    return [
        'title' => $faker->realText(100),
        'slug' => str_slug($faker->realText(30)),
        'body' => $faker->paragraph,
        'program_type_id' => $faker->randomElement([1,2,3,4]),
        'term_type_id' => $faker->randomElement($termTypes),
    ];
});
