<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Curso;
use Faker\Generator as Faker;

$factory->define(Curso::class, function (Faker $faker) {

    return [        
        'title' => $faker->word,
        'review' => $faker->text,
        'cover' => $faker->word,
        'password' => $faker->word,
        'asesor_id' => $faker->numberBetween(1,5),
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
    ];
});
