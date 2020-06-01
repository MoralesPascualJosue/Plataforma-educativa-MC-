<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Repositories\WorkRepository;
use App\Repositories\ActivitieRepository;
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

    public function __construct(WorkRepository $workRepo, ActivitieRepository $activitieRepo)
    {
        $this->workRepository = $workRepo;
        $this->activitieRepository = $activitieRepo;
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
            return "contenido vacio";
        }

        $activitie = $this->activitieRepository->find($id);
        $works = $activitie->works()->get()->where("estudiante_id","=",Auth::user()->estudiante()->get()["0"]->id)->count();

        if($activitie->intentos < $works+1){
            return "intentos alcanzados";
        }

        $input = $request->all();
        $input['contenido'] = $request->contenido; 
        $input['entregas'] = $works+1;
        $input['activitie_id'] = $id;
        $input['estudiante_id'] = Auth::user()->estudiante()->get()["0"]->id;

        $work = $this->workRepository->create($input);

        return "entrega guardada";
    }

    public function showworks($activitie,$estudiante)
    {
        if(!(Auth::user()->hasPermissionTo('edit cursos'))){
            return redirect()->route('inicio');
        }

        $activitie = $this->activitieRepository->find($activitie);
        $myworks = $activitie->works()->where("estudiante_id","=",$estudiante)->get();
        
        return $myworks;
    }
}
