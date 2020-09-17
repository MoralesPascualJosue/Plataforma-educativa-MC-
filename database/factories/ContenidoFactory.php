<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Contenido;
use Faker\Generator as Faker;

$factory->define(Contenido::class, function (Faker $faker) {

    return [
        'curso_id' => $faker->numberBetween(1,50),
        'activitie_id' => $faker->numberBetween(1,200),
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
    ];
});
