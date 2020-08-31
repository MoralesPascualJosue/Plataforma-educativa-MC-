<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateTaskRequest;
use App\Repositories\TaskRepository;
use App\Repositories\ActivitieRepository;
use Illuminate\Http\Request;

class TaskController extends Controller
{
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
            abort(404,'No disponible');
        }

         if(!$activitie->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
            abort(404,'No disponible');
        } 

        $task = $activitie->task()->get();

        if (empty($task)) {
            abort(404,'Contenido no disponible');
        }        

        $task = $this->taskRepository->update($request->all(), $task['0']->id);

        return "guardado";
    }

    public function trabajos($id, Request $request)
    {
        $activitie = $this->activitieRepository->find($id);

        if(empty($activitie)){
            abort(404,'No disponible');
        }

        if(!$activitie->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
            abort(404,'No disponible');
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
        
        return "No disponible";
    }


}
