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
        'asesor_id' => $faker->numberBetween(1,1000),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
