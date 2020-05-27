<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Asesor;
use Faker\Generator as Faker;

$factory->define(Asesor::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'image' => $faker->word,
        'bio' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
