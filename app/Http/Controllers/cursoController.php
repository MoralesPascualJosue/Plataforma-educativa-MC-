<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Asesor;
use App\Models\Activitie;
use App\Models\Test;
use App\Models\Test_result;
use App\Models\Estudiante;
use App\Models\Curso;
use App\Models\Work;
use App\Models\Qualification;
use App\Models\Matriculado;
use App\Repositories\MatriculadoRepository;
use App\Repositories\ActivitieRepository;
use App\Repositories\cursoRepository;

use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;



class cursoController extends Controller
{

    private $cursoRepository;
    private $matriculadoRepository;
    private $activitieRepository;
    private $mesesN;
    private $elementos;

    public function __construct(cursoRepository $cursoRepo,MatriculadoRepository $matriculadoRepo,ActivitieRepository $activitieRepo)
    {
        $this->mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
                    "Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $this->cursoRepository = $cursoRepo;
        $this->matriculadoRepository = $matriculadoRepo;
        $this->activitieRepository = $activitieRepo;
        $this->elementos = 12;
        $this->middleware('auth');
    }

    public function inicio(Request $request){
        $cursos;
        $miusuario = Auth::user();

        if($miusuario->hasPermissionTo('edit cursos')){
            $cursos = $this->cursoRepository->findWherePaginate("asesor_id","=",Auth::user()->asesor()->get()['0']->id,$this->elementos);
            foreach ($cursos as $curso) {                
                $curso['entregas'] = Qualification::where('curso_id',$curso->id)->where("estado",1)->count();
                $tests = Test::where('curso_id',$curso->id)->where("visible",1)->get();

                foreach($tests as $test){
                    $curso['entregas'] += Test_result::where('test_id',$test->id)->where('state',1)->count();
                }
             }
        }else{
            $cursos = Auth::user()->estudiante()->get()['0']->cursos()->where("matriculados.deleted_at",null)->orderBy("pivot_updated_at","DESC")->paginate($this->elementos);            
        } 

        if($request->ajax()){
            return $cursos;
        }
        
        return "No disponible";
    }

     public function notificaciones(Request $request)
    {     

        if(Auth::user()->hasPermissionTo('edit cursos')){
           return "No disponible";
        }
        
        $miusuario = Auth::user()->estudiante()->get()[0];

        $notificaciones["notificacionesnum"] = count($miusuario->unreadNotifications);
        $notificaciones["notificaciones"] = $miusuario->unreadNotifications;

        if($request->ajax()){
            return $notificaciones;
        }

        return "No disponible";
    }

     public function showCurso($id,Request $request)
    {                
        
        $curso = $this->cursoRepository->find($id);
        $actividades = [];
        $actividadeshoy= 0;
        $actividadessemana= 0;
        $miusuario;
        $tests=[];

        $hoy =  now()->toDateString();

        if (empty($curso)) {
           abort(404,"Curso no disponible");
        }        

        if(Auth::user()->hasPermissionTo('edit cursos')){
            if(!$curso->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
                abort(404,"Curso no disponible");
            }    
            $actividades = $curso->activities()->orderBy("activities.fecha_final","DESC")->paginate($this->elementos);            
            $tests = $curso->tests()->orderBy("tests.fecha_final","DESC")->paginate($this->elementos);
                      
            foreach ($actividades as $actividad) {                
                $actividad['entregas'] = Qualification::where('activitie_id',$actividad->id)->where("estado",1)->count();
             }

             foreach ($tests as $test) {                
                $test['entregas'] = $test->results()->where("state",1)->count();
             }
        }else{
            $miusuario = Auth::user()->estudiante()->get()[0];
            if(!$curso->hasMatriculado($miusuario->id)){
                abort(404,"Curso no disponible");
            }               

             $actividades = $curso->activities()->where("visible","=",1)->orderBy("activities.fecha_final","DESC")->paginate($this->elementos);
             $tests = $curso->tests()->where("visible",1)->orderBy("tests.fecha_final","DESC")->paginate($this->elementos);
             foreach ($actividades as $actividad) {
                 $actividad['entregas'] = Work::where("estudiante_id",$miusuario->id)
                 ->where("activitie_id",$actividad->id)
                 ->orderBy("id","desc")
                 ->first()
                 ;
             }

            $actividadeshoy = $curso->activities()->where("visible",1)->where("fecha_final",$hoy)->count();
            $actividadeshoy = $actividadeshoy + $curso->tests()->where("visible",1)->where("fecha_final",$hoy)->count();
            
            $actividadessemana = $curso->activities()->where("visible",1)->whereRaw("EXTRACT(week from fecha_final)=EXTRACT(week from NOW())")->count();
            $actividadessemana = $actividadessemana + $curso->tests()->where("visible",1)->whereRaw("EXTRACT(week from fecha_final)=EXTRACT(week from NOW())")->count();

            $curso["notificacionesnum"] = count($miusuario->unreadNotifications);
            $curso["notificaciones"] = $miusuario->unreadNotifications;

        }

        $curso["asesor"] = $curso->asesor()->get()[0];
        $data['curso'] = $curso;
        $data['actividades'] = $actividades;
        $data['actividadeshoy'] = $actividadeshoy;
        $data['actividadessemana'] = $actividadessemana;
        $data['tests'] = $tests;

        if($request->ajax()){
            return $data;
        }

        return "No disponible";
    }

     public function storea(Request $request)
    {        
        request()->validate([            
            'title' => 'required',
            'review' => 'required',
            'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if(!Auth::user()->hasPermissionTo('edit cursos')){
            return "No disponible";
        }

        $input =  $request->all();
        $input['cover'] = "resources/img-msg100.jpg";
        $input['asesor_id'] = Auth::user()->asesor()->get()['0']->id;
        $input['password'] = Str::random(10);

        $curso = $this->cursoRepository->create($input);

        if($request->file('cover')){
            $path = Storage::disk('public')->put('covers',$request->file('cover'));
            $curso->fill(['cover'=>$path])->save();
        }        

        if($request->ajax()){
            return $curso;
        }

        return "No disponible";
    }

    public function updatea($id, Request $request)
    {        
        $curso = $this->cursoRepository->find($id);  
        
        request()->validate([            
            'title' => 'required',
            'review' => 'required',
            'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if (empty($curso)) {
           abort(404,'Curso no disponible');
        }

        if(!$curso->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
            return "No disponible";
        } 

        $curso = $this->cursoRepository->update($request->all(), $id);

       if($request->file('cover')){
            $path = Storage::disk('public')->put('covers',$request->file('cover'));
            $curso->fill(['cover'=>$path])->save();
        }
        
        $curso->entregas = 0;

         if($request->ajax()){
            return $curso;
        }

        return "No disponible";
    }

    public function destroya($id)
    {
        $curso = $this->cursoRepository->find($id);

        if (empty($curso)) {
            return "No disponible";
        }

        if(!$curso->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
            return "No disponible";
        }

        $this->cursoRepository->delete($id);

       return "Eliminado";
    }

    /**/

    public function matricular(Request $request){

        if(!Auth::user()->hasPermissionTo('edit cursos')){
            $curso = $this->cursoRepository->findwhere("password","=",$request->title);
            
            if (count($curso) == 0) {
                abort(404,"Curso no encontrado");
            }

            $curso = $curso['0'];
            
            if(!$curso->hasMatriculado(Auth::user()->estudiante()->get()['0']->id)){
                               
                $datos["curso_id"] = $curso->id;
                $datos["estudiante_id"] = Auth::user()->estudiante()->get()['0']->id;
                $matricula = $this->matriculadoRepository->create($datos);

                return $curso;
            }   

            return "Ya estas registrado en este curso";    
        }
        
        return "No disponible";
    }

    public function desmatricular($cu,Request $request){

        $matricula;        
        $user = Auth::user();
        $curso = $this->cursoRepository->find($cu);

        if (empty($curso)) {
            abort(404,"No disponible");
        }

        if ($user->can("edit cursos")) {
            $matricula = Matriculado::where("estudiante_id",$request["estudiante"])
            ->where("curso_id",$cu)
            ->limit(1)->get();
        }else{
            $matricula = Matriculado::where("estudiante_id",$user->estudiante()->get()[0]->id)
            ->where("curso_id",$cu)
             ->limit(1)->get();
        }            

            
        if (empty($matricula)) {
            abort(404,"No disponible");
        }
            
        $this->matriculadoRepository->delete($matricula[0]->id);
                    
        return $curso;
    }

    public function trabajos($id,Request $request)
    {
        $curso = $this->cursoRepository->find($id);

        if(!$curso->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
            return "No disponible";
        } 

        $estudiantes = $curso->estudiantes()->orderBy("name")->get();
        $actividades = $curso->activities()->where("visible","=",1)->get();
        $tests = $curso->tests()->where("visible","=",1)->get();        

        foreach ($tests as $test) { 
            $actividades[] = $test;
        }        

        $cantidad_actividades = sizeof($actividades);
        for($i = 0;$i < $cantidad_actividades - 1 ;$i++)
        {
            for($j = $i +1;$j < $cantidad_actividades;$j++)
            {
                if($actividades[$i]->fecha_final > $actividades[$j]->fecha_final)
                {
                    $auxiliar = $actividades[$i];
                    $actividades[$i] = $actividades[$j];
                    $actividades[$j] = $auxiliar;
                }
            }
        }
        
        $curso['participantes'] = $estudiantes->count();

        foreach ($estudiantes as $estudi) {   
            $calificacionescontenedor = [];      
            $suma = 0;      
            foreach($actividades as $acti){
                if ($acti['type'] == "test") {
                    $calificacion = $acti->results()->where("estudiante_id","=", $estudi->id )->get();

                    if (empty($calificacion['0'])) {
                        $contenidocal["id"] = $acti->id;
                        $contenidocal['qualification'] = 'NA';
                        $contenidocal['estado'] = "NA";
                        $calificacion['0'] = $contenidocal;
                    }else{
                        $contenidocal["id"] = $acti->id;
                        $contenidocal['qualification'] = $calificacion[0]->result;
                        $contenidocal['estado'] = $calificacion[0]->state;
                        $calificacion['0'] = $contenidocal;
                    }

                    $calificacionescontenedor[] = $calificacion['0'];

                    if(is_numeric( $calificacion['0']['qualification'] )){
                        $suma = $suma + $calificacion['0']['qualification'];
                    }
                }else{
                     $calificacion = $acti->qualifications()->where("estudiante_id","=", $estudi->id )->get();

                    if (empty($calificacion['0'])) {
                        $contenidocal["id"] = $acti->id;
                        $contenidocal['qualification'] = 'NA';
                        $contenidocal['estado'] = "NA";
                        $calificacion['0'] = $contenidocal;
                    }                                    
                    
                    $calificacionescontenedor[] = $calificacion['0'];

                    if(is_numeric( $calificacion['0']['qualification'] )){
                        $suma = $suma + $calificacion['0']['qualification'];
                    }
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
        
        if($request->ajax()){
            $data["estudiantes"] = $estudiantes;
            $data["curso"] = $curso;
            $data["actividades"] = $actividades;
            return $data;
        }

        return "No disponible";
    }

    public function reporteListac($curso){
        $id = $curso;

        $curso = $this->cursoRepository->find($id);
        
        if(!$curso->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
            return "No disponible";
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
        $tests = $curso->tests()->where("visible","=",1)->get();        

        foreach ($tests as $test) { 
            $actividades[] = $test;
        }

        $cantidad_actividades = sizeof($actividades);
        for($i = 0;$i < $cantidad_actividades - 1 ;$i++)
        {
            for($j = $i +1;$j < $cantidad_actividades;$j++)
            {
                if($actividades[$i]->fecha_final > $actividades[$j]->fecha_final)
                {
                    $auxiliar = $actividades[$i];
                    $actividades[$i] = $actividades[$j];
                    $actividades[$j] = $auxiliar;
                }
            }
        }

        $curso['participantes'] = $estudiantes->count();        

        $numero = 1;
        foreach ($estudiantes as $estudi) {   

            $calificacionescontenedor = [];      
            $suma = 0;      
            foreach($actividades as $acti){
                if ($acti['type'] == "test") {
                    $calificacion = $acti->results()->where("estudiante_id","=", $estudi->id )->get();

                    if (empty($calificacion['0'])) {
                        $contenidocal["id"] = $acti->id;
                        $contenidocal['qualification'] = 'NA';
                        $contenidocal['estado'] = "NA";
                        $calificacion['0'] = $contenidocal;
                    }else{
                        $contenidocal["id"] = $acti->id;
                        $contenidocal['qualification'] = $calificacion[0]->result;
                        $contenidocal['estado'] = $calificacion[0]->state;
                        $calificacion['0'] = $contenidocal;
                    }

                    $calificacionescontenedor[] = $calificacion['0'];

                    if(is_numeric( $calificacion['0']['qualification'] )){
                        $suma = $suma + $calificacion['0']['qualification'];
                    }
                }else{
                     $calificacion = $acti->qualifications()->where("estudiante_id","=", $estudi->id )->get();

                    if (empty($calificacion['0'])) {
                        $contenidocal["id"] = $acti->id;
                        $contenidocal['qualification'] = 'NA';
                        $contenidocal['estado'] = "NA";
                        $calificacion['0'] = $contenidocal;
                    }                                    
                    
                    $calificacionescontenedor[] = $calificacion['0'];

                    if(is_numeric( $calificacion['0']['qualification'] )){
                        $suma = $suma + $calificacion['0']['qualification'];
                    }
                }
            }
            
                $promedio['qualification'] = round($suma/$actividades->count());
                $promedio['estado'] = "Promedio";
                $calificacionescontenedor[] = $promedio;

                $estudi["calificaciones"] = $calificacionescontenedor;  
                $estudi["numero"] = $numero;                            
            $numero++;
        }
        $actividadesa = $actividades;

        $pdf = PDF::loadView('reportes.reportelista',compact('estudiantes','curso','actividadesa','asesor',"periodo"));
        return $pdf->stream('invoice.pdf');
    }

    public function reporteListae($curso){  

        return Excel::download(new UsersExport($this->cursoRepository,$curso), 'lista.xlsx');
    }
    
    public function calificaciones($curso){

        $curso = Curso::find($curso);
        $miuser = Auth::user();

        if (empty($curso)) {
            abort(404,'Curso no valido');
        }

        if(!$curso->hasMatriculado($miuser->estudiante()->get()['0']->id)){
            abort(404,'Curso no disponible');
        }

        $actividades = $curso->activities()->where("visible","=",1)->get();
        $tests = $curso->tests()->where("visible","=",1)->get();        

        foreach ($tests as $test) { 
            $actividades[] = $test;
        }

        $calificacionescontenedor = [];      
        $suma = 0;      
        foreach($actividades as $acti){

             if ($acti['type'] == "test") {
                    $calificacion = $acti->results()->where("estudiante_id","=", $miuser->estudiante()->get()['0']->id )->get();

                    if (empty($calificacion['0'])) {
                        $contenidocal["id"] = $acti->id;
                        $contenidocal['qualification'] = 'NA';
                        $contenidocal['estado'] = "NA";
                        $calificacion['0'] = $contenidocal;
                    }else{
                        $contenidocal["id"] = $acti->id;
                        $contenidocal['qualification'] = $calificacion[0]->result;
                        $contenidocal['estado'] = $calificacion[0]->state;
                        $calificacion['0'] = $contenidocal;
                    }

                    $calificacionescontenedor[] = $calificacion['0'];

                    if(is_numeric( $calificacion['0']['qualification'] )){
                        $suma = $suma + $calificacion['0']['qualification'];
                    }
                }else{
                     $calificacion = $acti->qualifications()->where("estudiante_id","=", $miuser->estudiante()->get()['0']->id )->get();

                    if (empty($calificacion['0'])) {
                        $contenidocal["id"] = $acti->id;
                        $contenidocal['qualification'] = 'NA';
                        $contenidocal['estado'] = "NA";
                        $calificacion['0'] = $contenidocal;
                    }                                    
                    
                    $calificacionescontenedor[] = $calificacion['0'];

                    if(is_numeric( $calificacion['0']['qualification'] )){
                        $suma = $suma + $calificacion['0']['qualification'];
                    }
                }

        }

        $promedio['qualification']= 0;
        if ($actividades->count() != 0) {
            $promedio['qualification'] = round($suma/$actividades->count());   
        }            

          $actividadesa = $actividades->toArray();

        usort($actividadesa,function ($a,$b) {
            if ($a['fecha_final'] == $b['fecha_final']) {
                return 0;
            }
            return ($a['fecha_final'] < $b['fecha_final']) ? -1 : 1;
        });


        
        $promedio['estado'] = "Promedio";
        $calificacionescontenedor[] = $promedio;        
        $promedio['title'] = "Promedio";
        $actividadesa[] = $promedio;

        $data["calificaciones"] = $calificacionescontenedor;
        $data["actividades"] = $actividadesa;
        $data["estudiante"] = $miuser->estudiante()->get()['0'];
        
        return $data;
    }

}
