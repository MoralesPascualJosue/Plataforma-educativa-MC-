<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\curso;
use Faker\Generator as Faker;

$factory->define(curso::class, function (Faker $faker) {

    return [
        'title' => $faker->word,
        'review' => $faker->text,
        'cover' => $faker->word,
        'asesor_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
