<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Repositories\TaskRepository;
use App\Repositories\ActivitieRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use Illuminate\Support\Facades\Auth;


class TaskController extends AppBaseController
{
    /** @var  TaskRepository */
    private $taskRepository;
    private $activitieRepository;

    public function __construct(TaskRepository $taskRepo,ActivitieRepository $activitieRepo)
    {
        $this->taskRepository = $taskRepo;
        $this->activitieRepository = $activitieRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Task.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tasks = $this->taskRepository->all();

        return view('tasks.index')
            ->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new Task.
     *
     * @return Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created Task in storage.
     *
     * @param CreateTaskRequest $request
     *
     * @return Response
     */
    public function store(CreateTaskRequest $request)
    {
        $input = $request->all();

        $task = $this->taskRepository->create($input);

        Flash::success('Task saved successfully.');

        return redirect(route('tasks.index'));
    }

    /**
     * Display the specified Task.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $task = $this->taskRepository->find($id);

        if (empty($task)) {
            Flash::error('Task not found');

            return redirect(route('tasks.index'));
        }

        return view('tasks.show')->with('task', $task);
    }

    /**
     * Show the form for editing the specified Task.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $task = $this->taskRepository->find($id);

        if (empty($task)) {
            Flash::error('Task not found');

            return redirect(route('tasks.index'));
        }

        return view('tasks.edit')->with('task', $task);
    }

    /**
     * Update the specified Task in storage.
     *
     * @param int $id
     * @param UpdateTaskRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTaskRequest $request)
    {
        $task = $this->taskRepository->find($id);

        if (empty($task)) {
            Flash::error('Task not found');

            return redirect(route('tasks.index'));
        }

        $task = $this->taskRepository->update($request->all(), $id);

        Flash::success('Task updated successfully.');

        return redirect(route('tasks.index'));
    }

    /**
     * Remove the specified Task from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $task = $this->taskRepository->find($id);

        if (empty($task)) {
            Flash::error('Task not found');

            return redirect(route('tasks.index'));
        }

        $this->taskRepository->delete($id);

        Flash::success('Task deleted successfully.');

        return redirect(route('tasks.index'));
    }

    public function updatea($id, UpdateTaskRequest $request)
    {        

        $activitie = $this->activitieRepository->find($id);
        if (empty($activitie)) {
            abort(404,'Contenido no disponible');
        }

         if(!$activitie->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
                Flash::success('No tienes los permisos necesarios.');
                return redirect()->route('inicio');
        } 

        $task = $activitie->task()->get();

        if (empty($task)) {
            abort(404,'Contenido no disponible');
        }        

        $task = $this->taskRepository->update($request->all(), $task['0']->id);

        Flash::success('Guardado.');

        return "guardado";
    }

    public function trabajos($id)
    {
        $activitie = $this->activitieRepository->find($id);

        if(empty($activitie)){
                return redirect()->route('inicio');
        }

        if(!$activitie->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
                Flash::success('Actividad no registrado.');
                return redirect()->route('inicio');
        } 

        $curso = $activitie->cursos()->first();
        
        $estudiantes = $curso->estudiantes()->orderBy("name")->get();

        foreach($estudiantes as $estudiante){
            $qua = $estudiante->qualifications()->where("activitie_id","=",$id)->get();
            if(empty($qua['0'])){
                $estudiante["qualificationestado"] = "0";
                $estudiante["qualificationqualification"] = "Sin entregas";
            }else{
                $estudiante["qualificationestado"] =$qua['0']->estado;
                $estudiante["qualificationqualification"] = $qua['0']->qualification;
            }
        }

        $works = [];                
        return view('works.show_trabajos')
            ->with(compact('activitie','estudiantes','curso','works'));
    }


}
