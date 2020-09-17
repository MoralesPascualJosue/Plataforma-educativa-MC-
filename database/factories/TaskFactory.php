<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {

    return [
        'contenido' => $faker->text,
        'asesor_id' => $faker->numberBetween(1,5),
        'activitie_id' => $faker->numberBetween(1,50),
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
    ];
});
