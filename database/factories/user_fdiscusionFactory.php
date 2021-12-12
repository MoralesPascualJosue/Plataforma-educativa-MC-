<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\user_fdiscusion;
use Faker\Generator as Faker;

$factory->define(user_fdiscusion::class, function (Faker $faker) {

    return [
        'user_id' => $faker->numberBetween(1,56),
        'fdiscusion_id' => $faker->numberBetween(1,799),
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
    ];
});
