<?php

namespace App\Http\Controllers;

use App\Repositories\ActivitieRepository;
use App\Repositories\CursoRepository;
use App\Repositories\ContenidoRepository;
use App\Repositories\WorkRepository;
use App\Repositories\TaskRepository;
use App\Repositories\QualificationRepository;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Events\ActivitieEvent;

class ActivitieController extends Controller
{
    private $activitieRepository;
    private $contenidoRepository;
    private $taskRepository;
    private $workRepository;
    private $qualificationRepository;

    public function __construct(ActivitieRepository $activitieRepo, ContenidoRepository $contenidoRepo,TaskRepository $taskRepo,WorkRepository $workRepo,QualificationRepository $qualificationRepo)
    {
        $this->activitieRepository = $activitieRepo;
        $this->contenidoRepository = $contenidoRepo;
        $this->taskRepository = $taskRepo;
        $this->workRepository = $workRepo;
        $this->qualificationRepository = $qualificationRepo;
        $this->middleware('auth');
    }

     public function storea($id,Request $request)
    {
        $input =  [];
        $miusuario = Auth::user();

        if(!$miusuario->hasPermissionTo('edit cursos')){
            abort(404,"No disponible");
        }

        $miusuario = $miusuario->asesor()->get()['0'];

        $date = date("Y-m-d");
        $mod_date = strtotime($date."+ 2 days");
        
        $input['title'] = "Nueva actividad  $date ";        
        $input['visible'] = 0;
        $input['type'] = 'activitie';
        $input['intentos'] = 1;
        $input['fecha_inicio'] = $date;
        $input['fecha_final'] = date("Y-m-d",$mod_date); 
        $input['asesor_id'] = $miusuario->id;                    

        $activitie = $this->activitieRepository->create($input);

        $contenido['activitie_id'] = $activitie->id;
        $contenido['curso_id'] = $id;

        $task["contenido"] =  [
            'propsPage' => [ 
                'textColor' => '#f0f0f0',
                'backgroundColor' => '#f2f2f2',
                'widthPage' => 600,
                'alignPage' => 'center',
            ],
            'rows' => []
        ];
        $task['asesor_id'] =  $miusuario->id;
        $task['activitie_id'] = $activitie->id;        
        
        $this->contenidoRepository->create($contenido);
        $this->taskRepository->create($task);

        if($request->ajax()){
            return $activitie;
        }

        return "No disponible";
    }

    public function showActivitie($id,Request $request)
    {            
        $miusuario = Auth::user();
        $curso = [];
        $works= [];
        $qualification=[];
        $task = [];
        $activitie = $this->activitieRepository->find($id);        

        if (empty($activitie)) {            
           return "Actividad no encontrada";
        }

        $curso = $activitie->cursos()->first();

        if (empty($curso)) {
           return "Curso no disponible";
        }

        $task = $activitie->task()->get()['0']->contenido;        
        
        if($miusuario->hasPermissionTo('edit cursos')){
            $miusuario = $miusuario->asesor()->get()['0'];
            if(!$activitie->hasPropiedad($miusuario->id)){
                return "Actividad no registrada";
            }    
        }else{
            $miusuario = $miusuario->estudiante()->get()['0'];

            if(!$curso->hasMatriculado($miusuario->id) or $activitie->visible != 1){
                return "No disponible";
            }               
            
            $works = $activitie->works()->get()->where("estudiante_id","=",$miusuario->id);
            $calificacione = $activitie->qualifications()->where("estudiante_id","=",$miusuario->id);

            if($calificacione->count() != 0){
                $qualification = $calificacione->get()['0'];
            }else{
                $qualification['estado'] = 0;
                $qualification['qualification'] = "sin asignar";
                $qualification['observaciones'] = "sin entregas";
            }            

            if (!$request["n"] == "") {            
                $miusuario->unreadNotifications
                ->when( $request["n"], function($query) use ($request){
                    return $query->where('id',$request['n']);
                })->markAsRead();
            }
        }     
        
        if($request->ajax()){
            $data["activitie"] = $activitie;
            $data["curso"] = $curso;
            $data["task"] = $task;
            $data["works"] = $works;
            $data["entrega"] = sizeof($works);
            $data["qualification"] = $qualification;
            return $data;
        }

        return "No disponible";
    }

    public function destroya($id,Request $request)
    {
        $activitie = $this->activitieRepository->find($id);
        $curso = $activitie->cursos()->first()->id;
        if(!$activitie->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
                abort(404,"No disponible");
        } 

        if (empty($activitie)) {
            return 'Actividad no encontrada';
        }

        $this->activitieRepository->delete($id);

        if($request->ajax()){
            return "Actividad eliminada";
        }

       return "No disponible";
    }

    public function updatea($id, Request $request)
    {        

        $input = $request->all();

        $input["visible"] = 0;

        if($request["visible"] == "true" || $request["visible"] == "1"){
            $input["visible"] = 1;
        }

        $activitie = $this->activitieRepository->find($id);   
        $curso = $activitie->cursos()->get()[0];  
        
        if($input["fecha_inicio"] > $input["fecha_final"]){
            abort(403,"fechas no validas");
        } 
        
        if (empty($activitie)) {
           abort(404,'Actividad no disponible');
        }

        if(!$activitie->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
            return "Actividad no registrada";
        } 

        if ($activitie->visible == 0 and $input['visible'] == 1) {
            $activitie = $this->activitieRepository->update($input, $id);
            event(new ActivitieEvent($activitie,$curso));
        }else{
            $activitie = $this->activitieRepository->update($input, $id);
        }

         return $activitie;
    }

}

