<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Repositories\WorkRepository;
use App\Repositories\ActivitieRepository;
use App\Repositories\QualificationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use Illuminate\Support\Facades\Auth;

class WorkController extends AppBaseController
{
    /** @var  WorkRepository */
    private $workRepository;
    private $activitieRepository;
    private $qualificationRepository;

    public function __construct(WorkRepository $workRepo, ActivitieRepository $activitieRepo,QualificationRepository $qualificationRepo)
    {
        $this->workRepository = $workRepo;
        $this->activitieRepository = $activitieRepo;
        $this->qualificationRepository = $qualificationRepo;
        $this->middleware('auth');
    }

    /* ajax display */

    public function storea($id,Request $request)    
    {        
        if($request->contenido == ""){
            abort(404,"contenido vacio");
        }

        $activitie = $this->activitieRepository->find($id);
        if(empty($activitie)){
            abort(404,"Actividad no registrada");
        }

        $works = $activitie->works()->get()->where("estudiante_id","=",Auth::user()->estudiante()->get()["0"]->id)->count();

        if($activitie->intentos < $works+1){
            abort(404,"Intentos alcanzados");
        }

        $input = $request->all();
        $input['contenido'] = $request->contenido; 
        $input['entregas'] = $works+1;
        $input['activitie_id'] = $id;
        $input['estudiante_id'] = Auth::user()->estudiante()->get()["0"]->id;

        $work = $this->workRepository->create($input);

        $curso = $activitie->cursos()->first()->id;
        if($works+1 == 1){            

            $data["qualification"] = 0;
            $data["observaciones"] = "Sin observacions";
            $data["estado"] = 1;
            $data["activitie_id"] = $input['activitie_id'];
            $data["estudiante_id"] = $input['estudiante_id'];
            $data['curso_id'] = $curso;
            $qualification = $this->qualificationRepository->create($data);
        }

        $qualification = $activitie->qualifications()->where("estudiante_id","=",Auth::user()->estudiante()->get()['0']->id)->get()['0'];

        $inputq['estado'] = 1;
        $qualification->update($inputq);

        Flash::success('Entrega guardada');

        return $id;
    }

    public function showworks($activitie,$estudiante)
    {
        if(!(Auth::user()->hasPermissionTo('edit cursos'))){
            return redirect()->route('inicio');
        }

        $activitie = $this->activitieRepository->find($activitie);
        $qualification = $activitie->qualifications()->where("estudiante_id","=",$estudiante)->get();        
        $myworks["contenidos"] = $activitie->works()->where("estudiante_id","=",$estudiante)->get();

        if (empty($qualification['0'])) {
            $myworks2["qualification"] = "Sin asignar" ;
            $myworks2["estado"] = 0;
            $myworks2["observaciones"] = "Sin entregas";
            $myworks["detalles"] = $myworks2;
        }else{
            if ($qualification['0']->estado == 1) {
                $myworks2["estado"] = "Para revision";    
                $myworks2["qualification"] = "Para revision" ;
            }else{
                $myworks2["estado"] = $qualification['0']->estado;
                $myworks2["qualification"] = $qualification['0']->qualification ;
            }       

            $myworks2["observaciones"] = $qualification['0']->observaciones;
            $myworks["detalles"] = $myworks2;
        }
        
        $myworks["estudiante"] = $estudiante;
        
        return $myworks;
    }
    
}
