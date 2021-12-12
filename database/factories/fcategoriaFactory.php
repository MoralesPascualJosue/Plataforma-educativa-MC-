<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\fcategoria;
use Faker\Generator as Faker;

$factory->define(fcategoria::class, function (Faker $faker) {

    return [
        'name' => $faker->jobTitle,
        'color' => $faker->hexcolor,
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
    ];
});
