<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\fpost;
use Faker\Generator as Faker;

$factory->define(fpost::class, function (Faker $faker) {

    return [
        'body' => $faker->text,
        'locked' => $faker->randomDigitNotNull,
        'fdiscusion_id' => $faker->randomDigitNotNull,
        'user_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
