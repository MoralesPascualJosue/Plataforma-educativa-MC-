<?php

namespace App\Http\Controllers;

use App\Repositories\QualificationRepository;
use App\Repositories\ActivitieRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QualificationController extends Controller
{
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
            abort(404,"Formato invalido");
        }

        $activitie = $this->activitieRepository->find($id);

        if(empty($activitie)){
            abort(404,"No disponible");
        }        

        if(!$activitie->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
            abort(404,"No disponible");
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
            abort(404,"No disponible");
        }

        $update["qualification"] = $input["calificacion"];        
        $update["estado"] = 2;
        $update["observaciones"] = "Sin oberservaciones";

        $qualification = $this->qualificationRepository->update($update, $qualification->id);

        return $qualification;
    }
}
