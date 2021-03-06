<?php

use Illuminate\Database\Seeder;

class AsesorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       //Factory(App\Models\Matriculado::class,4500)->create();        
        //Factory(App\Models\Activitie::class,4500)->create();

        Factory(App\Models\Contenido::class,4500)->create();
        Factory(App\Models\Work::class,4500)->create();
        Factory(App\Models\Task::class,4500)->create();
        Factory(App\Models\Qualification::class,4500)->create();

        Factory(App\Models\fcategoria::class,200)->create();       
        Factory(App\Models\fdiscusion::class,2000)->create();
        Factory(App\Models\fpost::class,4500)->create();
        Factory(App\Models\user_fdiscusion::class,4500)->create();

    }

}
