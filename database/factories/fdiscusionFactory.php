<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\fdiscusion;
use Faker\Generator as Faker;

$factory->define(fdiscusion::class, function (Faker $faker) {

    return [
        'title' => $faker->word,
        'body' => $faker->text,
        'views' => $faker->randomDigitNotNull,
        'answered' => $faker->randomDigitNotNull,
        'user_id' => $faker->randomDigitNotNull,
        'curso_id' => $faker->randomDigitNotNull,
        'fcategoria' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
