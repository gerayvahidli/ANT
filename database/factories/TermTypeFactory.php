<?php

use Faker\Generator as Faker;

$factory->define(App\TermType::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(15),
        'slug' => str_slug($faker->realText(15)),
    ];
});
