<?php

use Illuminate\Database\Seeder;
use App\Models\Asesor;

class AsesorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Factory(App\Models\Asesor::class)->create([
              'user_id'=> 1,
            'name' => Str::random(10),
            'bio' => Str::random(10).'--bio',
            'institute' => 'Instituto Tecnologico de Oaxaca',
            'department' => 'Maestria en construccion',
            'telephone' => '9511782851'
        ]);

        Factory(App\Models\Asesor::class)->create([
                        'user_id'=> 2,
            'name' => Str::random(10),
            'bio' => Str::random(10).'--bio',
            'institute' => 'Instituto Tecnologico de Oaxaca',
            'department' => 'Maestria en construccion',
            'telephone' => '9511782852'
        ]);

        Factory(App\Models\Estudiante::class)->create([
           'user_id'=> 3,
            'name' => Str::random(10),
            'bio' => Str::random(10).'--bio',
            'institute' => 'Instituto Tecnologico de Oaxaca',
            'department' => 'Maestria en construccion',
            'telephone' => '9511782833'
        ]);

        Factory(App\Models\Estudiante::class)->create([
            'user_id'=> 4,
            'name' => Str::random(10),
            'bio' => Str::random(10).'--bio',
            'institute' => 'Instituto Tecnologico de Oaxaca',
            'department' => 'Maestria en construccion',
            'telephone' => '9511782854'
        ]);

        Factory(App\Models\Asesor::class)->create([
           'user_id'=> 5,
            'name' => Str::random(10),
            'bio' => Str::random(10).'--bio',
            'institute' => 'Instituto Tecnologico de Oaxaca',
            'department' => 'Maestria en Diseño',
            'telephone' => '9521782833'
        ]);

        Factory(App\Models\Asesor::class)->create([
            'user_id'=> 6,
            'name' => Str::random(10),
            'bio' => Str::random(10).'--bio',
            'institute' => 'Instituto Tecnologico de Oaxaca',
            'department' => 'Maestria en diseño',
            'telephone' => '9512782854'
        ]);

    }

}
