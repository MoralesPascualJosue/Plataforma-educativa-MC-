<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Qualification;
use Faker\Generator as Faker;

$factory->define(Qualification::class, function (Faker $faker) {

    return [
        'qualification' => $faker->randomDigitNotNull,
        'observaciones' => $faker->text,
        'estado' => $faker->randomDigitNotNull,
        'activitie_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
