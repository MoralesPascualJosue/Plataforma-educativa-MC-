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

    /**
     * Display a listing of the Qualification.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $qualifications = $this->qualificationRepository->all();

        return view('qualifications.index')
            ->with('qualifications', $qualifications);
    }

    /**
     * Show the form for creating a new Qualification.
     *
     * @return Response
     */
    public function create()
    {
        return view('qualifications.create');
    }

    /**
     * Store a newly created Qualification in storage.
     *
     * @param CreateQualificationRequest $request
     *
     * @return Response
     */
    public function store(CreateQualificationRequest $request)
    {
        $input = $request->all();

        $qualification = $this->qualificationRepository->create($input);

        Flash::success('Qualification saved successfully.');

        return redirect(route('qualifications.index'));
    }

    /**
     * Display the specified Qualification.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $qualification = $this->qualificationRepository->find($id);

        if (empty($qualification)) {
            Flash::error('Qualification not found');

            return redirect(route('qualifications.index'));
        }

        return view('qualifications.show')->with('qualification', $qualification);
    }

    /**
     * Show the form for editing the specified Qualification.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $qualification = $this->qualificationRepository->find($id);

        if (empty($qualification)) {
            Flash::error('Qualification not found');

            return redirect(route('qualifications.index'));
        }

        return view('qualifications.edit')->with('qualification', $qualification);
    }

    /**
     * Update the specified Qualification in storage.
     *
     * @param int $id
     * @param UpdateQualificationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQualificationRequest $request)
    {
        $qualification = $this->qualificationRepository->find($id);

        if (empty($qualification)) {
            Flash::error('Qualification not found');

            return redirect(route('qualifications.index'));
        }

        $qualification = $this->qualificationRepository->update($request->all(), $id);

        Flash::success('Qualification updated successfully.');

        return redirect(route('qualifications.index'));
    }

    /**
     * Remove the specified Qualification from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $qualification = $this->qualificationRepository->find($id);

        if (empty($qualification)) {
            Flash::error('Qualification not found');

            return redirect(route('qualifications.index'));
        }

        $this->qualificationRepository->delete($id);

        Flash::success('Qualification deleted successfully.');

        return redirect(route('qualifications.index'));
    }

     public function updatea($id, Request $request)     
    {        

        $input = $request->all();

        if(empty($input['calificacion'])){
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
        
        if($qualification->count() == 0){
            $data["qualification"] = 0;
            $data["observaciones"] = ".";
            $data["estado"] = 1;
            $data["activitie_id"] = $id;
            $data["estudiante_id"] = $input["estudiante"];
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
