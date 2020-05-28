<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Activitie;
use Faker\Generator as Faker;

$factory->define(Activitie::class, function (Faker $faker) {

    return [
        'title' => $faker->word,
        'visible' => $faker->randomDigitNotNull,
        'intentos' => $faker->randomDigitNotNull,
        'fecha_inicio' => $faker->word,
        'fecha_final' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
