<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\fpost;
use Faker\Generator as Faker;

$factory->define(fpost::class, function (Faker $faker) {

    return [
        'body' => $faker->paragraph($nbSentences = 5, $variableNbSentences = true),
        'locked' => $faker->randomDigitNotNull,
        'fdiscusion_id' => $faker->numberBetween(1,799),
        'user_id' => $faker->numberBetween(1,56),   
        'parent' => $faker->numberBetween(0,4499),
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
    ];
});
