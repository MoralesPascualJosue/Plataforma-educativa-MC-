<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Work;
use Faker\Generator as Faker;

$factory->define(Work::class, function (Faker $faker) {

    return [
        'contenido' => $faker->text,
        'entregas' => $faker->randomDigitNotNull,
        'activitie_id' => $faker->randomDigitNotNull,
        'estudiante_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
