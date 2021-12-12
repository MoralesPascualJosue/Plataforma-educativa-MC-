<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {

    $mjson = [
                        "propsPage"=> [
                            "textColor"=> "#c21919",
                            "backgroundColor"=> "#c9dbe9",
                            "widthPage"=> 650,
                            "alignPage"=> "center"
                        ],
                        "rows"=> [
                            [
                            "rowpos"=> 0,
                            "columns"=> [
                                [
                                "column"=> 0,
                                "type"=> "Vacio",
                                "width"=> "activitieeditor-column-100",
                                "propsContainer"=> [
                                    "props"=> [
                                    "fontSize"=> "22px",
                                    "fontWeight"=> "normal",
                                    "lineHeight"=> "140%"
                                    ],
                                    "value"=> "vacio 100"
                                ]
                                ]
                            ]
                            ],
                            [
                            "rowpos"=> 0,
                            "columns"=> [
                                [
                                "use"=> "bloque",
                                "type"=> "Videoblock",
                                "propsContainer"=> [
                                    "props"=> [
                                    "backgroundColor"=> "#f2f2f2"
                                    ],
                                    "src"=> [
                                    "url"=> "/resources/icons/video-vacio.svg",
                                    "height"=> 310
                                    ]
                                ],
                                "width"=> "activitieeditor-column-100",
                                "columnindex"=> 0,
                                "rowindex"=> 1
                                ]
                            ]
                            ],
                            [
                            "rowpos"=> 1,
                            "columns"=> [
                                [
                                "use"=> "bloque",
                                "type"=> "Heading",
                                "propsContainer"=> [
                                    "props"=> [
                                    "color"=> "#a2a2a2",
                                    "fontSize"=> "22px",
                                    "fontWeight"=> "300",
                                    "lineHeight"=> "140%",
                                    "textAlign"=> "left"
                                    ],
                                    "value"=> "Heading default"
                                ],
                                "width"=> "activitieeditor-column-50",
                                "columnindex"=> 0,
                                "rowindex"=> 1
                                ],
                                [
                                "use"=> "bloque",
                                "type"=> "Textblock",
                                "propsContainer"=> [
                                    "props"=> [
                                    "fontSize"=> "23px",
                                    "lineHeight"=> "210%",
                                    "color"=> "#c21414",
                                    "textAlign"=> "center"
                                    ],
                                    "value"=> "Soy un gran texto por defecto con valor."
                                ],
                                "width"=> "activitieeditor-column-50",
                                "columnindex"=> 1,
                                "rowindex"=> 1
                                ]
                            ]
                            ],
                            [
                            "rowpos"=> 2,
                            "columns"=> [
                                [
                                "use"=> "bloque",
                                "type"=> "Imageblock",
                                "propsContainer"=> [
                                    "props"=> [
                                    "textAlign"=> "center",
                                    "backgroundColor"=> "#ffffff"
                                    ],
                                    "src"=> [
                                    "url"=> "/resources/icons/imagen-vacio.svg",
                                    "height"=> "100",
                                    "width"=> "179"
                                    ]
                                ],
                                "width"=> "activitieeditor-column-100",
                                "columnindex"=> 0,
                                "rowindex"=> 2
                                ]
                            ]
                            ],
                            [
                            "rowpos"=> 3,
                            "columns"=> [
                                [
                                "use"=> "bloque",
                                "type"=> "Textblock",
                                "propsContainer"=> [
                                    "props"=> [
                                    "fontSize"=> "14px",
                                    "lineHeight"=> "140%",
                                    "color"=> "#000000",
                                    "textAlign"=> "left"
                                    ],
                                    "value"=> "i´m a text default"
                                ],
                                "width"=> "activitieeditor-column-66",
                                "columnindex"=> 0,
                                "rowindex"=> 3
                                ],
                                [
                                "use"=> "bloque",
                                "type"=> "Heading",
                                "propsContainer"=> [
                                    "props"=> [
                                    "color"=> "#a2a2a2",
                                    "fontSize"=> "22px",
                                    "fontWeight"=> "300",
                                    "lineHeight"=> "140%",
                                    "textAlign"=> "left"
                                    ],
                                    "value"=> "Heading default"
                                ],
                                "width"=> "activitieeditor-column-33",
                                "columnindex"=> 1,
                                "rowindex"=> 3
                                ]
                            ]
                            ],
                            [
                            "rowpos"=> 3,
                            "columns"=> [
                                [
                                "use"=> "bloque",
                                "type"=> "Archivoblock",
                                "propsContainer"=> [
                                    "props"=> [
                                    "fontSize"=> "14px",
                                    "textAlign"=> "center",
                                    "backgroundColor"=> "#2faade"
                                    ],
                                    "archivos"=> []
                                ],
                                "width"=> "activitieeditor-column-33",
                                "columnindex"=> 0,
                                "rowindex"=> 3
                                ],
                                [
                                "use"=> "bloque",
                                "type"=> "Docpdf",
                                "propsContainer"=> [
                                    "props"=> [
                                    "backgroundColor"=> "#f2f2f2"
                                    ],
                                    "src"=> [
                                    "url"=> "/resources/icons/document-vacio.svg",
                                    "height"=> "650"
                                    ]
                                ],
                                "width"=> "activitieeditor-column-66",
                                "columnindex"=> 1,
                                "rowindex"=> 3
                                ]
                            ]
                            ]
                        ]
                        ];

    return [
        'contenido' => $mjson,
        'asesor_id' => $faker->numberBetween(1,14),
        'activitie_id' => $faker->numberBetween(1,50),
        'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years', $timezone = null),
        'updated_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
    ];
});
