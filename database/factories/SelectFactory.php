<?php

use Faker\Generator as Faker;

$factory->define(App\Select::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'allowsMultiple' => 0,
        //
    ];
});
