<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\fdiscusion;
use Faker\Generator as Faker;

$factory->define(fdiscusion::class, function (Faker $faker) {

    return [
        'title' => $faker->company,
        'body' => $faker->text,
        'views' => $faker->randomDigitNotNull,
        'answered' => $faker->randomDigitNotNull,
        'user_id' => $faker->numberBetween(1,56),
        'curso_id' => $faker->numberBetween(1,100),   
        'fcategoria' => $faker->numberBetween(1,49),
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
    ];
});
