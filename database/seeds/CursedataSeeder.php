<?php

use Spatie\Permission\Models\Role;
use App\User;
use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\Matriculado;
use App\Models\Contenido;
use App\Models\Activitie;
use App\Models\Task;
use App\Models\Work;
use App\Models\Qualification;
use Illuminate\Database\Seeder;

class CursedataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        factory(App\User::class, 10)->create()->each(function ($user) {
            $role = Role::findByName('Asesor');
            $user->assignRole($role);
            $asesor = $user->asesor()->save(factory(App\Models\Asesor::class)->make());
            $asesor->cursos()->createMany(
                factory(App\Models\Curso::class, 10)->make()->toArray()
            );
        });
        

        factory(App\User::class, 40)->create()->each(function ($user) {
            $role = Role::findByName('Estudiante');
            $user->assignRole($role);
            $estudiante = $user->estudiante()->save(factory(App\Models\Estudiante::class)->make());     
            $cursos = Curso::all();
            foreach ($cursos as $curso ) {
                Matriculado::create([
                    'estudiante_id' => $estudiante->id,
                    'curso_id' => $curso->id,
                ]);
            }
        });

        $cursos = Curso::all();
        foreach ($cursos as $curso ) {
            $actividades = $curso->activities()->createMany(
                factory(App\Models\Activitie::class, 30)->make([
                        'asesor_id' => $curso->asesor_id,
                ])->toArray()
            );                         
        }

        $cursos = Curso::all();

        foreach ($cursos as $curso) {
            $actividades = $curso->activities()->get();

            foreach ($actividades as $actividad) {
                $actividad->task()->save(factory(App\Models\Task::class)->make([
                    'asesor_id' => $curso->asesor_id,
                ]));
            }
        }

        $estudiantes = Estudiante::all();
        $actividades = Activitie::all();

        foreach ($estudiantes as $estudiante) {
            foreach ($actividades as $actividad) {
                $resp = rand(5, 15);                
                if ($resp > 10) {
                    $curso = $actividad->cursos()->first()->id;

                    factory(Work::class)->create([
                        'estudiante_id' => $estudiante->id,
                        'activitie_id' => $actividad->id,
                        'entregas' => 1,
                    ]);

                    factory(Qualification::class)->create([
                        'estudiante_id' => $estudiante->id,
                        'activitie_id' => $actividad->id,
                        'curso_id' => $curso,
                    ]);
                }         
            }
        }
        
        /*
        Factory(App\Models\Asesor::class,10)->create();
        Factory(App\Models\Estudiante::class,40)->create();
        Factory(App\Models\Curso::class,20)->create();
        Factory(App\Models\Matriculado::class,800)->create();        
        Factory(App\Models\Activitie::class,400)->create();

        Factory(App\Models\Contenido::class,400)->create();
        Factory(App\Models\Work::class,400)->create();
        Factory(App\Models\Task::class,4500)->create();
        Factory(App\Models\Qualification::class,4500)->create();

        Factory(App\Models\fcategoria::class,50)->create();       
        Factory(App\Models\fdiscusion::class,800)->create();
        Factory(App\Models\fpost::class,4500)->create();
        Factory(App\Models\user_fdiscusion::class,4500)->create();**/

    }

}
