<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Anuncio;
use Faker\Generator as Faker;

$factory->define(Anuncio::class, function (Faker $faker) {

    return [
        'anuncio' => $faker->word,
        'user_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
