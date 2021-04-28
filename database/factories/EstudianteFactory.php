<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Estudiante;
use Faker\Generator as Faker;

$factory->define(Estudiante::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'bio' => $faker->text,  
        'institute' => $faker->word,
        'department' => $faker->word,
        'telephone' => '0',
        'user_id' => $faker->numberBetween(1001,2000),   
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
