<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\EstudianteRepository;
use App\Models\Work;
use App\Models\Test_result;

class HomeworkController extends Controller
{
    private $estudianteRepository;
    private $mesesN;

     public function __construct(EstudianteRepository $estudianteRepo)
    {
        $this->mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
                    "Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $this->estudianteRepository = $estudianteRepo;
        $this->middleware('auth');
    }

    public function homework(Request $request)
    {
        $user;
        $cursos;
        $perfil['perfil'] = Auth::user()->roles()->pluck('name')['0']; 
        $hoy =  now()->toDateString();
        $entregas = 0;

        if($perfil['perfil'] == "Asesor"){
            abort(404,'No disponible');
        }else{
            $user = $this->estudianteRepository->findwhere("user_id","=",Auth::user()->id)->first();  
        }

        if (empty($user)) {
            abort(404,'No disponible');
        }

        $cursos = Auth::user()->estudiante()->get()['0']->cursos()->where("matriculados.deleted_at",null)->get();

        foreach($cursos as $curso){
            $actividades = $curso->activities()->where("visible",1)->where("fecha_final",$hoy)->get();
            foreach ($actividades as $actividad) {                                
                 $actividad['entregas'] = Work::where("estudiante_id",$user->id)
                 ->where("activitie_id",$actividad->id)
                 ->orderBy("id","desc")
                 ->count()
                 ;
            }            

            $tests = $curso->tests()->where("visible",1)->where("fecha_final",$hoy)->get();
            foreach ($tests as $test) {
                 $test['entregas'] = Test_result::where("estudiante_id",$user->id)
                 ->where("test_id",$test->id)
                 ->orderBy("id","desc")
                 ->count()
                 ;
            }

            $curso["dataA"] = $actividades;
            $curso["dataB"] = $tests;

            $entregas = $entregas + count($actividades);
            $entregas = $entregas + count($tests);
        }

        if($request->ajax()){
            $anoi = date("Y");
            $mesi= date("n");
            $day = date("d");
            $data["cursos"] = $cursos;
            $data["fecha"] = $day." de ".$this->mesesN[$mesi]." del ".$anoi;;
            $data["hoy"] = $hoy;
            $data["entregas"] = $entregas;
            return $data;
        }

        return "No disponible";
    }
}
