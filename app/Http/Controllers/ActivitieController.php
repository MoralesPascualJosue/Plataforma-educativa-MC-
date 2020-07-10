<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateActivitieRequest;
use App\Http\Requests\UpdateActivitieRequest;
use App\Repositories\ActivitieRepository;
use App\Repositories\ContenidoRepository;
use App\Repositories\WorkRepository;
use App\Repositories\TaskRepository;
use App\Repositories\QualificationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;


class ActivitieController extends AppBaseController
{
    /** @var  ActivitieRepository */
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

    /* ajax display */

     public function storea($id,Request $request)
    {

        if(!Auth::user()->hasPermissionTo('edit cursos')){
            return redirect(route('inicio'));
        }

        $date = date("Y-m-d");
        $mod_date = strtotime($date."+ 2 days");

        $input =  [];
        $input['title'] = "Nueva actividad  $date ";        
        $input['visible'] = 0;
        $input['intentos'] = 1;
        $input['fecha_inicio'] = $date;
        $input['fecha_final'] = date("Y-m-d",$mod_date); 
        $input['asesor_id'] = Auth::user()->asesor()->get()['0']->id;
                
        $activitie = $this->activitieRepository->create($input);

        $contenido['activitie_id'] = $activitie->id;
        $contenido['curso_id'] = $id;
        
        $this->contenidoRepository->create($contenido);

        
        $task["contenido"] = "Escribe tu contenido aqui...";
        $task['asesor_id'] =  Auth::user()->asesor()->get()['0']->id;
        $task['activitie_id'] = $activitie->id;


        $this->taskRepository->create($task);

        Flash::success('Actividad creada.');

        return redirect(route('scursoc',$id));
    }

    public function showActivitie($id,Request $request)
    {        
        $activitie = $this->activitieRepository->find($id);
        if (empty($activitie)) {
            Flash::success('Actividad no encontrada.');
           return redirect()->route('inicio');
        }

        $curso = $activitie->cursos()->first();

         if (empty($curso)) {
           return redirect()->route('inicio');
        }

        $task = $activitie->task()->get()['0']->contenido;
        $works= [];
        $qualification=[];
        
        if(Auth::user()->hasPermissionTo('edit cursos')){
            if(!$activitie->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
                Flash::success('Actividad no registrado.');
                return redirect()->route('inicio');
            }    
        }else{
            if(!$curso->hasMatriculado(Auth::user()->estudiante()->get()['0']->id) or !($activitie->visible == 1)){                
                return redirect()->route('inicio');
            }               
            $works = $activitie->works()->get()->where("estudiante_id","=",Auth::user()->estudiante()->get()['0']->id);

            $calificacione = $activitie->qualifications()->where("estudiante_id","=",Auth::user()->estudiante()->get()['0']->id);
            if(!$calificacione->count() == 0){
                $qualification = $calificacione->get()['0'];
            }else{
                $qualification['estado'] = 0;
                $qualification['qualification'] = "sin asignar";
                $qualification['observaciones'] = "sin entregas";
            }

        }

        $view = \View::make('activities.show')->with(compact('activitie','curso','task','works','qualification'));
        
        return $view;
    }

    public function destroya($id)
    {
        $activitie = $this->activitieRepository->find($id);
        $curso = $activitie->cursos()->first()->id;
        if(!$activitie->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
                Flash::success('Actividad no registrada.');
                return redirect()->route('inicio');
        } 

        if (empty($activitie)) {

            return 'Actividad no encontrada';
        }

        $this->activitieRepository->delete($id);

        Flash::success('Actividad eliminada.');

       return Response()->json([ 'curso' => $curso]);
    }

    public function updatea($id, UpdateactivitieRequest $request)
    {        

        $input = $request->all();

        $input["visible"] = 0;

        if($request["visible"] == "true"){
            $input["visible"] = 1;
        }

        $activitie = $this->activitieRepository->find($id);       
        
        if($input["fecha_inicio"] > $input["fecha_final"]){
                abort(403,"fechas no validas");
        } 
        
        if (empty($activitie)) {
           abort(404,'Actividad no disponible');
        }

        if(!$activitie->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
                Flash::success('Actividad no registrado.');
                return redirect()->route('inicio');
        } 

        $activitie = $this->activitieRepository->update($input, $id);

         return "Actualizado";
    }
//////////////////////////////////////////uploads

    public function uploadFileimage(Request $request){
        if ($files = $request->file('fileToUpload')) {
             $id = Auth::user()->id;
            request()->validate([
                'fileToUpload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $fileName = "fileName".time().'.'.request()->fileToUpload->getClientOriginalExtension();
            $ruta = request()->fileToUpload->storeAs('images/'.$id,$fileName,'public');
            return asset($ruta);
        }

        abort(402,"Archivo no seleccionado");

    }

    public function uploadFilevideo(Request $request){
        if ($files = $request->file('fileToUpload')) {
             $id = Auth::user()->id;
            request()->validate([
                'fileToUpload' => 'required|mimes:mpeg,mp4,webm,mov,flv,avi,wmv|max:307200'
            ]);
            $fileName = "fileName".time().'.'.request()->fileToUpload->getClientOriginalExtension();
            $ruta = request()->fileToUpload->storeAs('media/'.$id,$fileName,'public');
            return asset($ruta);
        }

        abort(402,"Archivo no seleccionado");

    }

    public function uploadFiledoc(Request $request){
        if ($files = $request->file('fileToUpload')) {
             $id = Auth::user()->id;
            request()->validate([
                'fileToUpload' => 'required|mimes:pdf|max:30720'
            ]);
            $fileName = "fileName".time().'.'.request()->fileToUpload->getClientOriginalExtension();
            $ruta = request()->fileToUpload->storeAs('archivos/'.$id,$fileName,'public');
            return asset($ruta);
        }

        abort(402,"Archivo no seleccionado");

    }
}

