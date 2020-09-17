<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Matriculado;
use Faker\Generator as Faker;

$factory->define(Matriculado::class, function (Faker $faker) {

    return [
        'estudiante_id' => $faker->numberBetween(1,50),
        'curso_id' => $faker->numberBetween(1,50),
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
    ];
});
