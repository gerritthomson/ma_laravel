<?php

use Faker\Generator as Faker;
use App\Option;
$factory->define(App\Option::class, function (Faker $faker) {
    return [
        'label' => $faker->name,
        'value' =>  uniqid('option'),
        'select_id' => $faker->randomDigit
        //
    ];
});
