<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Models\Curso;
use App\Models\Qualification;


class informacionController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }

      public function informacion($cur,Request $request)
    {    
         
        $user = Auth::user();
        $curso = Curso::find($cur);
        $promedio = Qualification::where("curso_id",$cur)->where("qualification",">","69")->avg("qualification");

        if($user->cannot("edit cursos")){
            abort(404,"Permisos no suficientes");
        }

        $matriculados = $curso->estudiantes()->count();        
        $tactividades = $curso->activities()->where("visible",1)->count();
        $actividades = $curso->activities()->where("visible",1)->get();

        if($request->ajax()){
            $data["curso"] = $curso->password;
            $data["matriculados"]=$matriculados;
            $data["tactividades"]=$tactividades;
            $data["promedio"]=$promedio;
            $actividades["actividades"] = $actividades;

            return $data;
        }
        
        return "No disponible";
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
