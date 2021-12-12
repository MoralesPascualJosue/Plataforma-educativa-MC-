<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Anuncio;
use Faker\Generator as Faker;

$factory->define(Anuncio::class, function (Faker $faker) {    
    $data = array(
                [
                    [
                        "type"=>"image",
                        "heigth"=>1,
                        "width"=>1,
                        "source"=>'/resources/default/info1.png'
                    ],
                    [
                        "type"=>"description",
                        "source"=>'<div><br></div><div><br></div>Inicia la construcción de la primera etapa de la 
                                    "Unidad Multifuncional De Talleres y Laboratorios',
                        "heigth"=>1,
                        "width"=>1,
                        "size"=>26,
                        "align"=>"center"
                    ],
                    [
                        "type"=>"image",
                        "source"=>'/resources/default/info2.png',
                        "heigth"=>1,
                        "width"=>1
                    ],
                    [
                        "type"=>"description",
                        "source"=>'<div><br></div><div><br></div><div>Instituto Tecnológico de Oaxaca implementa Sistema de Gestión de la Calidad.</div><div><br></div>
                                    <div>Con el objetivo de implementar el Sistema de Gestión de la Calidad, así como la mejora continua en nuestros procesos,
                                     con los requisitos de la Norma ISO 9001=>2015, esta mañaana se aperturaron los trabajos de la 4° auditoría interna.</div>',
                        "heigth"=>1,
                        "width"=>1,
                        "size"=>18,
                        "align"=>"center"
                    ]
                ],
                [
                    [
                        "type"=>"image",
                        "heigth"=>2,
                        "width"=>3,
                        "source"=>'/resources/default/info3.png'
                    ],
                    [
                        "type"=>"description",
                        "source"=>'<div><br></div><div><br></div>Encuesta de Clima y Cultura Organizacional 2021.',
                        "heigth"=>1,
                        "width"=>2,
                        "size"=>22,
                        "align"=>"center"
                    ]
                ]
            );
    
    $datawidth = array(2,5);
    $dataheight = array(2,3);

    $fakernumber = $faker->numberBetween(0,1);

    return [
        'anuncio' => 'anuncio base',
        'anuncioblock' => $data[$fakernumber],
        'user_id' => 5,
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
        'heigthblock' => $dataheight[$fakernumber],
        'widthblock' => $datawidth[$fakernumber],
    ];
});
