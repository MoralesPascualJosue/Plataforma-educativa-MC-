<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatecursoRequest;
use App\Http\Requests\UpdatecursoRequest;
use App\Repositories\cursoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Flash;
use Response;

use Illuminate\Support\Facades\Storage;
use App\Models\Asesor;
use App\Models\Activitie;
use App\Models\Estudiante;
use App\Models\Curso;
use App\Models\Work;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MatriculadoRepository;
use App\Repositories\ActivitieRepository;
use Barryvdh\DomPDF\Facade as PDF;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;



class cursoController extends AppBaseController
{
    /** @var  cursoRepository
     *  @var  MatriculadoRepository
     */
    private $cursoRepository;
    private $matriculadoRepository;
    private $activitieRepository;
    private $mesesN;

    public function __construct(cursoRepository $cursoRepo,MatriculadoRepository $matriculadoRepo,ActivitieRepository $activitieRepo)
    {
        $this->mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
                    "Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $this->cursoRepository = $cursoRepo;
        $this->matriculadoRepository = $matriculadoRepo;
        $this->activitieRepository = $activitieRepo;
        $this->middleware('auth');
    }

    /* Displat with ajax */


    public function inicio(Request $request)
    {     
        $cursos;

        if (!$request["ele"] == "") {
            $elementos = $request["ele"];
        }else{
            $elementos = 12;
        }

        if(Auth::user()->hasPermissionTo('edit cursos')){
            $cursos = $this->cursoRepository->findWherePaginate("asesor_id","=",Auth::user()->asesor()->get()['0']->id,$elementos);
        }else{
            $cursos = Auth::user()->estudiante()->get()['0']->cursos()->orderBy("pivot_updated_at","DESC")->paginate($elementos);            
        } 

        $cursos->appends(['ele' => $elementos]);

        $view = \View::make('cursos.inicioc')->with('cursos',$cursos);

        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }
        
        return $view;
    }

     public function notificaciones(Request $request)
    {     

        if(Auth::user()->hasPermissionTo('edit cursos')){
           return redirect()->back();
        }
        
        $curso = [];
        $miusuario = Auth::user()->estudiante()->get()[0];

        $curso["notificacionesnum"] = count($miusuario->unreadNotifications);
        $curso["notificaciones"] = $miusuario->unreadNotifications;
        $curso["readnotificaciones"] = $miusuario->readNotifications;

        $view = \View::make('informacion.notificaciones')->with(compact('curso'));

        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }
        
        return $view;
    }

     public function showCurso($id,Request $request)
    {        
        $curso = $this->cursoRepository->find($id);
        $actividades = [];
        $actividadeshoy= [];
        $actividadessemana= [];
        $miusuario;

        $hoy =  now()->toDateString();

        if (empty($curso)) {
            Flash::success('Curso no registrado.');
           return redirect()->route('inicio');
        }        

        if(Auth::user()->hasPermissionTo('edit cursos')){
            if(!$curso->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
                Flash::success('Curso no registrado.');
                return redirect()->route('inicio');
            }    
            $actividades = $curso->activities()->orderBy("activities.updated_at","DESC")->paginate(10);
        }else{
            $miusuario = Auth::user()->estudiante()->get()[0];
            if(!$curso->hasMatriculado($miusuario->id)){
                Flash::success('Curso no registrado.');
                return redirect()->route('inicio');
            }   

             $actividades = $curso->activities()
             ->where("visible","=",1)
             ->orderBy("activities.fecha_final","DESC")->paginate(10);

             foreach ($actividades as $actividad) {
                 $actividad['entregas'] = Work::where("estudiante_id",$miusuario->id)
                 ->where("activitie_id",$actividad->id)
                 ->orderBy("id","desc")
                 ->first()
                 ;
             }

            $actividadeshoy = $curso->activities()->where("visible","=",1)->where("fecha_final","=",$hoy)->get();
            $actividadessemana = $curso->activities()->where("visible","=",1)
             ->whereRaw("EXTRACT(week from fecha_final)=EXTRACT(week from NOW())")->get();

            $curso["notificacionesnum"] = count($miusuario->unreadNotifications);
            $curso["notificaciones"] = $miusuario->unreadNotifications;

        }
        
        $view = \View::make('scurso')->with(compact('curso','actividades','actividadeshoy','actividadessemana'));

        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }
        
        return $view;
    }

     public function storea(Request $request)
    {
        if(!Auth::user()->hasPermissionTo('edit cursos')){
            return redirect(route('inicio'));
        }

        $input =  [];
        $input['title'] = "Nombre de curso";
        $input['cover'] = "resources/img-msg100.jpg";
        $input['review'] = "Breve mensaje";
        $input['asesor_id'] = Auth::user()->asesor()->get()['0']->id;
        $input['password'] = Str::random(10);

        $curso = $this->cursoRepository->create($input);

        Flash::success('Curso creado.');

        return redirect(route('scursoc',$curso->id));
    }

    public function updatea($id, UpdatecursoRequest $request)
    {        
        $curso = $this->cursoRepository->find($id);        

        if (empty($curso)) {
           abort(404,'Curso no disponible');
        }

        if(!$curso->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
                Flash::success('Curso no registrado.');
                return redirect()->route('inicio');
        } 

        $curso = $this->cursoRepository->update($request->all(), $id);

       if($request->file('cover')){
            $path = Storage::disk('public')->put('covers',$request->file('cover'));
            $curso->fill(['cover'=>$path])->save();
        }

        Flash::success('Curso actualizado.');

        $actividades = $curso->activities()->orderBy("activities.updated_at","DESC")->paginate(10);
        
        $view = \View::make('scurso')->with(compact('curso','actividades'));

        $sections = $view->renderSections();

        return Response::json($sections['content']);
    }

    public function updatecover($id, Request $request)
    {
        $curso = $this->cursoRepository->find($id);        

        if (empty($curso)) {
            Flash::error('Curso not found');

            abort(403,'error no disponible');
        }

        if(!$curso->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
                Flash::success('Curso no registrado.');
                return redirect()->route('inicio');
            } 

       if($request->file('cover')){
            $path = Storage::disk('public')->put('covers',$request->file('cover'));
            $curso->fill(['cover'=>$path])->save();
        }

        Flash::success('Imagen actualizada.');

        $actividades = $curso->activities()->orderBy("activities.updated_at","DESC")->paginate(10);
        
        $view = \View::make('scurso')->with(compact('curso','actividades'));

        $sections = $view->renderSections();
        
        return Response::json($sections['content']);
    }

    public function destroya($id)
    {
        $curso = $this->cursoRepository->find($id);

        if (empty($curso)) {
            Flash::error('Curso not found');

            abort(404,'Anuncio no disponible');
        }

        if(!$curso->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
                Flash::success('Curso no registrado.');
                return redirect()->route('inicio');
            } 

        $this->cursoRepository->delete($id);

        Flash::success('Curso eliminado.');

       return Response()->json([ 'Curso' => 'curso']);
    }

    /**/

    public function matricular(Request $request){

        if(!Auth::user()->hasPermissionTo('edit cursos')){
            $curso = $this->cursoRepository->findwhere("password","=",$request->title);
            
            if (count($curso) == 0) {
                Flash::error('Curso no encontrado');
                return redirect(route('inicio'));  
            }

            $curso = $curso['0'];
            
            if(!$curso->hasMatriculado(Auth::user()->estudiante()->get()['0']->id)){
                               
                $datos["curso_id"] = $curso->id;
                $datos["estudiante_id"] = Auth::user()->estudiante()->get()['0']->id;
                $matricula = $this->matriculadoRepository->create($datos);

                Flash::success('Curso registrado.');

                return redirect(route('inicio'));     
            }   

            Flash::success('Curso existente');
            
            return redirect(route('inicio'));     

        }
        
        return redirect(route('inicio'));            
    }


    public function trabajos($id)
    {
        $curso = $this->cursoRepository->find($id);

        if(!$curso->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
                Flash::success('Curso no registrado.');
                return redirect()->route('inicio');
        } 

        $estudiantes = $curso->estudiantes()->orderBy("name")->get();
        $actividades = $curso->activities()->where("visible","=",1)->get();

        $curso['participantes'] = $estudiantes->count();

        foreach ($estudiantes as $estudi) {   
            $calificacionescontenedor = [];      
            $suma = 0;      
            foreach($actividades as $acti){
                
                $calificacion = $acti->qualifications()->where("estudiante_id","=", $estudi->id )->get();

                if (empty($calificacion['0'])) {
                    $contenidocal["id"] = $acti->id;
                    $contenidocal['qualification'] = 'NA';
                    $contenidocal['estado'] = "NA";
                    $calificacion['0'] = $contenidocal;
                }                                    
                
                $calificacionescontenedor[$acti->id] = $calificacion['0'];

                if(is_numeric( $calificacion['0']['qualification'] )){
                    $suma = $suma + $calificacion['0']['qualification'];
                }

            }

            $promedio['qualification']= 0;
            if ($actividades->count() != 0) {
             $promedio['qualification'] = round($suma/$actividades->count());   
            }            
            
            $promedio['estado'] = "Proemdio";
            $calificacionescontenedor["promedio"] = $promedio;

            $estudi["calificaciones"] = $calificacionescontenedor;  
        }        

        return view('cursos.show_activities')->with(compact('estudiantes','curso','actividades'));
    }

    public function historiale($id)
    {
        $curso = $this->cursoRepository->find($id);
        $estudiante = Auth::user()->estudiante()->get()[0];

        if(!$curso->hasMatriculado($estudiante->id)){
                Flash::success('Curso no registrado.');
                return redirect()->route('inicio');
        } 

        $actividades = $curso->activities()->where("visible",1)->get();
    
        foreach ($actividades as $actividad) {
            $entregas = $actividad->works()->where("estudiante_id",$estudiante->id)->get();

            if(empty($entregas[0])){
                $actividad["works"] = "Sin entregas";
            }else{
                $actividad["works"] = $entregas;
            }
        }

        return $actividades;
    }

    public function historialu($cur,$est)
    {
        $curso = $this->cursoRepository->find($cur);
        $estudiante = Estudiante::find($est);

        if(!$curso->hasMatriculado($estudiante->id)){
                Flash::success('Curso no registrado.');
                return redirect()->route('inicio');
        } 

        $actividades = $curso->activities()->where("visible",1)->get();
    
        foreach ($actividades as $actividad) {
            $entregas = $actividad->works()->where("estudiante_id",$estudiante->id)->get();

            if(empty($entregas[0])){
                $actividad["works"] = "Sin entregas";
            }else{
                $actividad["works"] = $entregas;
            }
        }

        return $actividades;
    }

    public function reporteListac($curso){
        $id = $curso;

        $curso = $this->cursoRepository->find($id);
        
        if(!$curso->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
                Flash::success('Curso no registrado.');
                return redirect()->route('inicio');
        } 

        $anoi = date("Y");
        $mesi= date("n");
        $mod_date = strtotime($curso->created_at);
        $anof = date('Y',$mod_date);
        $mesf = date('n',$mod_date);
         
        $periodoi = $this->mesesN[$mesf]."/".$anof;
        $periodof = $this->mesesN[$mesi]."/".$anoi;
        $periodo =  $periodoi." - ".$periodof;

        $asesor = $curso->asesor()->get(["name"])[0];

        $estudiantes = $curso->estudiantes()->orderBy("name")->get();
        
        $actividades = $curso->activities()->where("visible","=",1)->get();

        $curso['participantes'] = $estudiantes->count();

        $numero = 1;
        foreach ($estudiantes as $estudi) {   
            $calificacionescontenedor = [];      
            $suma = 0;                  
            foreach($actividades as $acti){
                
                $calificacion = $acti->qualifications()->where("estudiante_id","=", $estudi->id )->get();

                if (empty($calificacion['0'])) {
                    $contenidocal["id"] = $acti->id;
                    $contenidocal['qualification'] = 'NA';
                    $contenidocal['estado'] = "NA";
                    $calificacion['0'] = $contenidocal;
                }                                    
                
                $calificacionescontenedor[$acti->id] = $calificacion['0'];

                if(is_numeric( $calificacion['0']['qualification'] )){
                    $suma = $suma + $calificacion['0']['qualification'];
                }                

            }
            
            $promedio['qualification'] = round($suma/$actividades->count());
            $promedio['estado'] = "Proemdio";
            $calificacionescontenedor["promedio"] = $promedio;

            $estudi["calificaciones"] = $calificacionescontenedor;  
            $estudi["numero"] = $numero;
            $numero++;
        }        


        $pdf = PDF::loadView('reportes.reportelista',compact('estudiantes','curso','actividades','asesor',"periodo"));
        return $pdf->stream('invoice.pdf');
    }

    public function reporteListae($curso){  

        return Excel::download(new UsersExport($this->cursoRepository,$curso), 'lista.xlsx');
    }
    
}
