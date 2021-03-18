<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Models\Curso;
use App\Models\Qualification;
use App\Models\Test_result;


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
	$tests = $curso->tests()->where("visible", "=", 1)->count();

        if($request->ajax()){
            $data["curso"] = $curso->password;
            $data["matriculados"]=$matriculados;
            $data["tactividades"]=$tactividades + $tests;
            $data["promedio"]=$promedio;
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
	$tests = $curso->tests()->where("visible",1)->get();
	foreach($tests as $test){
		$actividades[] = $test;
	}
	$cantidad_actividades = sizeof($actividades);

		for($i = 0; $i < $cantidad_actividades - 1; $i++){
		for($j = $i+1; $j < $cantidad_actividades; $j++){
			if($actividades[$i]->fecha_final > $actividades[$j]->fecha_final){
				$auxiliar = $actividades[$i];
				$actividades[$i] = $actividades[$j];
				$actividades[$j] = $auxiliar;
			}
		}
	}


        foreach ($actividades as $actividad) {
		if($actividad['type'] == "test"){
			$actividad["works"] = $actividad->results()->count();
		}else{
			$actividad["works"] = $actividad->works()->count();
		}
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

	$calificaciones = Qualification::where("curso_id",$cur)->where("qualification",">","69")->get("qualification");
	return $calificaciones;

    }
   
}
