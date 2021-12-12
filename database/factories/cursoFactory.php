<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Curso;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Curso::class, function (Faker $faker) {

    $covers = array(
        '/resources/default/portada1.png',
        '/resources/default/portada2.jpg',
        '/resources/default/portada3.jpg',
        '/resources/default/portada4.jpg',
        '/resources/default/portada5.jpg',
        '/resources/default/portada6.jpg',
        '/resources/default/portada7.png',
        '/resources/default/portada8.jpg',
        '/resources/default/portada9.png',
        '/resources/default/portada10.jpg',
        '/resources/default/portada11.png',
        '/resources/default/portada12.jpg',
        '/resources/default/portada13.jpg',
        '/resources/default/portada14.jpg',
        '/resources/default/portada15.jpg',
        '/resources/default/portada16.png',
        '/resources/default/portada17.jpg',
        '/resources/default/portada18.png',
        '/resources/default/portada19.jpg',
        '/resources/default/portada20.jpg'
    );

    $fakenumber = $faker->numberBetween(0,19);

    return [        
        'title' => $faker->bothify('??####-#'),
        'review' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'cover' => $covers[$fakenumber],
        'password' => $faker->bothify('??####-#???'),
                'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
