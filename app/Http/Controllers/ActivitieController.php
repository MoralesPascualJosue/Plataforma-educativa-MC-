<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateActivitieRequest;
use App\Http\Requests\UpdateActivitieRequest;
use App\Repositories\ActivitieRepository;
use App\Repositories\ContenidoRepository;
use App\Repositories\TaskRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;


class ActivitieController extends AppBaseController
{
    /** @var  ActivitieRepository */
    private $activitieRepository;
    private $contenidoRepository;
    private $taskRepository;

    public function __construct(ActivitieRepository $activitieRepo, ContenidoRepository $contenidoRepo,TaskRepository $taskRepo)
    {
        $this->activitieRepository = $activitieRepo;
        $this->contenidoRepository = $contenidoRepo;
        $this->taskRepository = $taskRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Activitie.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $activities = $this->activitieRepository->all();

        return view('activities.index')
            ->with('activities', $activities);
    }

    /**
     * Show the form for creating a new Activitie.
     *
     * @return Response
     */
    public function create()
    {
        return view('activities.create');
    }

    /**
     * Store a newly created Activitie in storage.
     *
     * @param CreateActivitieRequest $request
     *
     * @return Response
     */
    public function store(CreateActivitieRequest $request)
    {
        $input = $request->all();

        $input['asesor_id'] = Auth::user()->asesor()->get()['0']->id;

        $activitie = $this->activitieRepository->create($input);

        Flash::success('Activitie saved successfully.');

        return redirect(route('activities.index'));
    }

    /**
     * Display the specified Activitie.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $activitie = $this->activitieRepository->find($id);
        if (empty($activitie)) {
            Flash::error('Activitie not found');

            return redirect(route('activities.index'));
        }

        return view('activities.show')->with(compact('activitie'));
    }

    /**
     * Show the form for editing the specified Activitie.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $activitie = $this->activitieRepository->find($id);

        if (empty($activitie)) {
            Flash::error('Activitie not found');

            return redirect(route('activities.index'));
        }

        return view('activities.edit')->with('activitie', $activitie);
    }

    /**
     * Update the specified Activitie in storage.
     *
     * @param int $id
     * @param UpdateActivitieRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivitieRequest $request)
    {
        $activitie = $this->activitieRepository->find($id);

        if (empty($activitie)) {
            Flash::error('Activitie not found');

            return redirect(route('activities.index'));
        }

        $activitie = $this->activitieRepository->update($request->all(), $id);

        Flash::success('Activitie updated successfully.');

        return redirect(route('activities.index'));
    }

    /**
     * Remove the specified Activitie from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $activitie = $this->activitieRepository->find($id);

        if (empty($activitie)) {
            Flash::error('Activitie not found');

            return redirect(route('activities.index'));
        }

        $this->activitieRepository->delete($id);

        Flash::success('Activitie deleted successfully.');

        return redirect(route('activities.index'));
    }

    /* ajax display */

     public function storea($id,Request $request)
    {

        if(!Auth::user()->hasPermissionTo('edit cursos')){
            return redirect(route('inicio'));
        }

        $date = date("Y-m-d");
        $mod_date = strtotime($date."+ 2 days");

        $input =  [];
        $input['title'] = "Nueva actividad  $date ";        
        $input['visible'] = 0;
        $input['intentos'] = 1;
        $input['fecha_inicio'] = $date;
        $input['fecha_final'] = date("Y-m-d",$mod_date); 
        $input['asesor_id'] = Auth::user()->asesor()->get()['0']->id;
                
        $activitie = $this->activitieRepository->create($input);

        $contenido['activitie_id'] = $activitie->id;
        $contenido['curso_id'] = $id;
        
        $this->contenidoRepository->create($contenido);

        
        $task["contenido"] = "Escribe tu contenido aqui...";
        $task['asesor_id'] =  Auth::user()->asesor()->get()['0']->id;
        $task['activitie_id'] = $activitie->id;


        $this->taskRepository->create($task);

        Flash::success('Actividad creada.');

        return redirect(route('scursoc',$id));
    }

    public function showActivitie($id,Request $request)
    {        
        $activitie = $this->activitieRepository->find($id);
        if (empty($activitie)) {
            Flash::success('Actividad no encontrada.');
           return redirect()->route('inicio');
        }

        $curso = $activitie->cursos()->first();

         if (empty($curso)) {
           return redirect()->route('inicio');
        }

        if(Auth::user()->hasPermissionTo('edit cursos')){
            if(!$activitie->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
                Flash::success('Actividad no registrado.');
                return redirect()->route('inicio');
            }    
        }else{
            if(!$curso->hasMatriculado(Auth::user()->estudiante()->get()['0']->id) or !($activitie->visible == 1)){                
                return redirect()->route('inicio');
            }               
        }

        $task = $activitie->task()->get()['0']->contenido;


        $view = \View::make('activities.show')->with(compact('activitie','curso','task'));

        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }
        
        return $view;
    }

    public function destroya($id)
    {
        $activitie = $this->activitieRepository->find($id);
        $curso = $activitie->cursos()->first()->id;
        if(!$activitie->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
                Flash::success('Actividad no registrada.');
                return redirect()->route('inicio');
        } 

        if (empty($activitie)) {
            Flash::error('Actividad no encontrada');

            abort(404,'Anuncio no disponible');
        }

        $this->activitieRepository->delete($id);

        Flash::success('Actividad eliminada.');

       return Response()->json([ 'curso' => $curso]);
    }

    public function updatea($id, UpdateactivitieRequest $request)
    {        
        $activitie = $this->activitieRepository->find($id);       
        
        if($request->fecha_inicio > $request->fecha_final){
                abort(403,"fechas no validas");
        } 
        

        if (empty($activitie)) {
           abort(404,'Actividad no disponible');
        }

        if(!$activitie->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
                Flash::success('Actividad no registrado.');
                return redirect()->route('inicio');
        } 

        $activitie = $this->activitieRepository->update($request->all(), $id);

        Flash::success('Actividad actualizada.');
        
        $curso = $activitie->cursos()->first();
        $task = $activitie->task()->get()["0"]->contenido;
        
         $view = \View::make('activities.show')->with(compact('activitie','curso','task'));
         
        $sections = $view->renderSections();

        return Response::json($sections['content']);
    }
//////////////////////////////////////////exmapels

    public function postatc($id,Request $request){
        request()->validate(['file' => 'image']);
        return request()->file->storeAs('uploads/'.$id, request()->file->getClientOriginalName());
    }

    public function file($file){
       return Storage::response("uploads/12/$file");
    }

    public function uploadFilePost($id,Request $request){
        request()->validate([
            'fileToUpload' => 'required|file|max:1024',
        ]);

        $fileName = "fileName".time().'.'.request()->fileToUpload->getClientOriginalExtension();

        return request()->fileToUpload->storeAs('documents/'.$id,$fileName);

    }
}
