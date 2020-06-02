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

    /**
     * Display a listing of the Work.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $works = $this->workRepository->all();

        return view('works.index')
            ->with('works', $works);
    }

    /**
     * Show the form for creating a new Work.
     *
     * @return Response
     */
    public function create()
    {
        return view('works.create');
    }

    /**
     * Store a newly created Work in storage.
     *
     * @param CreateWorkRequest $request
     *
     * @return Response
     */
    public function store(CreateWorkRequest $request)
    {
        $input = $request->all();

        $work = $this->workRepository->create($input);

        Flash::success('Work saved successfully.');

        return redirect(route('works.index'));
    }

    /**
     * Display the specified Work.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $work = $this->workRepository->find($id);

        if (empty($work)) {
            Flash::error('Work not found');

            return redirect(route('works.index'));
        }

        return view('works.show')->with('work', $work);
    }

    /**
     * Show the form for editing the specified Work.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $work = $this->workRepository->find($id);

        if (empty($work)) {
            Flash::error('Work not found');

            return redirect(route('works.index'));
        }

        return view('works.edit')->with('work', $work);
    }

    /**
     * Update the specified Work in storage.
     *
     * @param int $id
     * @param UpdateWorkRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWorkRequest $request)
    {
        $work = $this->workRepository->find($id);

        if (empty($work)) {
            Flash::error('Work not found');

            return redirect(route('works.index'));
        }

        $work = $this->workRepository->update($request->all(), $id);

        Flash::success('Work updated successfully.');

        return redirect(route('works.index'));
    }

    /**
     * Remove the specified Work from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $work = $this->workRepository->find($id);

        if (empty($work)) {
            Flash::error('Work not found');

            return redirect(route('works.index'));
        }

        $this->workRepository->delete($id);

        Flash::success('Work deleted successfully.');

        return redirect(route('works.index'));
    }

    /* ajax display */

    public function storea($id,Request $request)    
    {        
        if($request->contenido == ""){
            abort(404,"contenido vacio");
        }

        $activitie = $this->activitieRepository->find($id);
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
        $inputq;
        if($works+1 == 1){            
            $inputq['qualification'] = 0;
            $inputq['observaciones'] = "";
            $inputq['estado'] = 1;
            $inputq['activitie_id'] = $input['activitie_id'];
            $inputq['estudiante_id'] = $input['estudiante_id'];

            $this->qualificationRepository->create($inputq);
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
