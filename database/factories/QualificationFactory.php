<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Qualification;
use Faker\Generator as Faker;

$factory->define(Qualification::class, function (Faker $faker) {

    return [
        'qualification' => $faker->numberBetween(0,100),
        'observaciones' => $faker->text,
        'estado' => $faker->numberBetween(1,3),
        'activitie_id' => $faker->numberBetween(1,50),
        'curso_id' => $faker->numberBetween(1,50),
        'estudiante_id' => $faker->numberBetween(1,50),
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
    ];
});
