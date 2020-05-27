<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Estudiante;
use Faker\Generator as Faker;

$factory->define(Estudiante::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'bio' => $faker->text,
        'image' => $faker->word,
        'institute' => $faker->word,
        'department' => $faker->word,
        'telephone' => $faker->word,
        'user_id' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
