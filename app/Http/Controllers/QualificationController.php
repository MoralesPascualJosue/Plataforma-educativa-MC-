<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQualificationRequest;
use App\Http\Requests\UpdateQualificationRequest;
use App\Repositories\QualificationRepository;
use App\Repositories\ActivitieRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\Auth;

class QualificationController extends AppBaseController
{
    /** @var  QualificationRepository */
    private $qualificationRepository;
    private $activitieRepository;

    public function __construct(QualificationRepository $qualificationRepo,ActivitieRepository $activitieRepo)
    {
        $this->qualificationRepository = $qualificationRepo;
        $this->activitieRepository = $activitieRepo;
        $this->middleware('auth');
    }

     public function updatea($id, Request $request)     
    {        

        $input = $request->all();

        if(empty($input['calificacion'])  or  !is_numeric($input['calificacion']) or $input['calificacion'] < 0 or $input['calificacion']>100){
            Flash::success('calificacion no registrado.');
            return $id;
        }

        $activitie = $this->activitieRepository->find($id);

        if(empty($activitie)){
            Flash::success('calificacion no registrado.');
            return $id;
        }        

        if(!$activitie->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
            Flash::success('Actividad no registrada.');
            return $id;
        } 

        $qualification = $activitie->qualifications()->where("estudiante_id","=",$input["estudiante"])->get();
        $curso = $activitie->cursos()->first()->id;
        
        if($qualification->count() == 0){
            $data["qualification"] = 0;
            $data["observaciones"] = "Sin observaciones";
            $data["estado"] = 1;
            $data["activitie_id"] = $id;
            $data["estudiante_id"] = $input["estudiante"];
            $data['curso_id'] = $curso;
            $qualification = $this->qualificationRepository->create($data);
        }else{
            $qualification = $qualification['0'];
        }


        if (empty($qualification)) {
            Flash::error('Calificacion no asignada');
            return $id;
        }

        $update["qualification"] = $input["calificacion"];        
        $update["estado"] = 2;

        if(empty($input["observaciones"])){
            $update["observaciones"] = " Observaciones:". $input["observaciones"]." Calificación: ".$input["calificacion"];
        }else{
            $update["observaciones"] = $input["observaciones"];
        }

        $qualification = $this->qualificationRepository->update($update, $qualification->id);

        Flash::success('Calificacion asignada.');

        return $id;
    }
}
