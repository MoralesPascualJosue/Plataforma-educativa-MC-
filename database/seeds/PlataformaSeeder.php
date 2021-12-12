<?php

use Illuminate\Database\Seeder;
use App\Models\Anuncio;
class PlataformaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        /*
        Factory(App\Models\Asesor::class,10)->create();
        Factory(App\Models\Estudiante::class,40)->create();
        Factory(App\Models\Curso::class,20)->create();
        Factory(App\Models\Matriculado::class,800)->create();        
        Factory(App\Models\Activitie::class,400)->create();

        Factory(App\Models\Contenido::class,400)->create();
        Factory(App\Models\Work::class,400)->create();
        Factory(App\Models\Task::class,4500)->create();
        Factory(App\Models\Qualification::class,4500)->create();/** */
        
        Factory(App\Models\fpost::class,4500)->create();
        Factory(App\Models\user_fdiscusion::class,4500)->create();
    }
}
