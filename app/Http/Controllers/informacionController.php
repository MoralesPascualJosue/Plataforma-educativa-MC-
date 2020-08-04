<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Qualification;
use Auth;

class informacionController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }

      public function informacion($cur,Request $request)
    {    
         
        $user = Auth::user();
        $curso = Curso::find($cur); //top bar
        $promedio = Qualification::where("curso_id",$cur)->where("qualification",">","69")->avg("qualification");//promedio curso

        if($user->cannot("edit cursos")){
               abort(404,"Permisos no suficientes");
        }

        $matriculados = $curso->estudiantes()->count();        
        $tactividades = $curso->activities()->where("visible",1)->count();
        $actividades = $curso->activities()->where("visible",1)->get();

        $view = \View::make('informacion.content')->with(compact("curso","matriculados","tactividades","promedio","actividades"));

        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }
        
        return $view;
    }

/*Entregas realizadas por actividad */
     public function informacionActividades($cur,Request $request)
    { 
         
        $user = Auth::user();
        $curso = Curso::find($cur);

        if($user->cannot("edit cursos")){
               abort(404,"Permisos no suficientes");
        }

        $actividades = $curso->activities()->where("visible",1)->get();

        foreach ($actividades as $actividad) {
            $actividad["works"] = $actividad->works()->count();
        }
        
        return $actividades;
    }

    /* calificaciones curso  */
     public function informacionCursop($cur)
    { 
         
        $curso = Curso::find($cur);
        $aprovechamiento = [];

        if(!$curso->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
                Flash::success('Curso no registrado.');
                return redirect()->route('inicio');
        } 

        $calilficaciones = Qualification::where("curso_id",$cur)->where("qualification",">","69")->get("qualification");
        
        return $calilficaciones;
    }
    
  
}
