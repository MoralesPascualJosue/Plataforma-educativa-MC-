<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\fpost;
use Faker\Generator as Faker;

$factory->define(fpost::class, function (Faker $faker) {

    return [
        'body' => $faker->text,
        'locked' => $faker->randomDigitNotNull,
        'fdiscusion_id' => $faker->numberBetween(1,1000),
        'user_id' => $faker->numberBetween(1,60),   
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
    ];
});
