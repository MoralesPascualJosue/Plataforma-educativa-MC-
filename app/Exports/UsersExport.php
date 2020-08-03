<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

use App\Repositories\cursoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Auth;

class UsersExport implements FromView
{    
    private $cursoRepository;
    private $mesesN;
    private $curso;

    public function __construct(cursoRepository $cursoRepo,$curso)
    {
        $this->mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
                    "Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $this->cursoRepository = $cursoRepo;
        $this->curso = $curso;
    }

     public function view(): View
    {

         $id = $this->curso;

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

        return view('reportes.reportee', compact('estudiantes','curso','actividades','asesor',"periodo"));
    }
}
