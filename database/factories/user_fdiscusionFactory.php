<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\user_fdiscusion;
use Faker\Generator as Faker;

$factory->define(user_fdiscusion::class, function (Faker $faker) {

    return [
        'user_id' => $faker->randomDigitNotNull,
        'fdiscusion_id' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
