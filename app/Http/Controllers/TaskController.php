<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Repositories\TaskRepository;
use App\Repositories\ActivitieRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use Illuminate\Support\Facades\Auth;


class TaskController extends AppBaseController
{
    /** @var  TaskRepository */
    private $taskRepository;
    private $activitieRepository;

    public function __construct(TaskRepository $taskRepo,ActivitieRepository $activitieRepo)
    {
        $this->taskRepository = $taskRepo;
        $this->activitieRepository = $activitieRepo;
        $this->middleware('auth');
    }


    public function updatea($id, UpdateTaskRequest $request)
    {        

        $activitie = $this->activitieRepository->find($id);
        if (empty($activitie)) {
            abort(404,'Contenido no disponible');
        }

         if(!$activitie->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
                Flash::success('No tienes los permisos necesarios.');
                return redirect()->route('inicio');
        } 

        $task = $activitie->task()->get();

        if (empty($task)) {
            abort(404,'Contenido no disponible');
        }        

        $task = $this->taskRepository->update($request->all(), $task['0']->id);

        Flash::success('Guardado.');

        return "guardado";
    }

    public function trabajos($id, Request $request)
    {
        $activitie = $this->activitieRepository->find($id);

        if(empty($activitie)){
            return redirect()->route('inicio');
        }

        if(!$activitie->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
            Flash::success('Actividad no registrado.');
            return redirect()->route('inicio');
        } 

        $curso = $activitie->cursos()->first();
        
        $estudiantes = $curso->estudiantes()->orderBy("name")->get();
        $numeroentregas = 0;
        $enrevision = 0;
        foreach($estudiantes as $estudiante){
            $qua = $estudiante->qualifications()->where("activitie_id","=",$id)->get();
            if(empty($qua['0'])){
                $estudiante["qualificationestado"] = "Sin entregas";
                $estudiante["qualificationqualification"] = "NA";
            }else{
                $estudiante["qualificationestado"] =$qua['0']->estado;
                $estudiante["qualificationqualification"] = $qua['0']->qualification;
                
                if($qua['0']->estado == 1){
                    $enrevision++;
                }

                $numeroentregas++;
            }
        }

        $works = [];      
        if($request->ajax()){
            $data["activitie"] = $activitie;
            $data["estudiantes"] = $estudiantes;
            $data["curso"] = $curso;
            $data["works"] = $works;
            $data["numeroentregas"] = $numeroentregas;
            $data["enrevision"] = $enrevision;

            return $data;
        }          
        return view('works.show_trabajos')
            ->with(compact('activitie','estudiantes','curso','works'));
    }


}
