<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Activitie;
use Faker\Generator as Faker;

$factory->define(Activitie::class, function (Faker $faker,$id) {

    return [
        'title' => $faker->word,
        'visible' => '1',        
        'intentos' => $faker->numberBetween(1,5),
        'type' => "activitie",
        'fecha_inicio' => $faker->date('Y-m-d H:i:s'),
        'fecha_final' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
        // 'created_at' => $faker->dateTime($max = 'now', $timezone = null),
        // 'updated_at' => $faker->dateTime($max = 'now', $timezone = null)
    ];
});
