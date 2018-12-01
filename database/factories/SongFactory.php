<?php

use Faker\Generator as Faker;

$factory->define(App\Song::class, function (Faker $faker) {
    return [
        'title' => substr($faker->sentence(2), 0, -1),
        'artist' => $faker->paragraph,
        'key' => $faker->word,
    ];
});
