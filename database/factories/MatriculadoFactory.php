<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Matriculado;
use Faker\Generator as Faker;

$factory->define(Matriculado::class, function (Faker $faker) {

    return [
        'estudiante_id' => $faker->word,
        'curso_id' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
