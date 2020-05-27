<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatecursoRequest;
use App\Http\Requests\UpdatecursoRequest;
use App\Repositories\cursoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Flash;
use Response;

use Illuminate\Support\Facades\Storage;
use App\Models\Asesor;
use App\Models\Estudiante;
use App\Models\Curso;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MatriculadoRepository;


class cursoController extends AppBaseController
{
    /** @var  cursoRepository
     *  @var  MatriculadoRepository
     */
    private $cursoRepository;
    private $matriculadoRepository;

    public function __construct(cursoRepository $cursoRepo,MatriculadoRepository $matriculadoRepo)
    {
        $this->cursoRepository = $cursoRepo;
        $this->matriculadoRepository = $matriculadoRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the curso.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cursos = $this->cursoRepository->all();        
        $cursos = Curso::orderBy('id','DESC')->paginate(3);

        return view('cursos.index')
            ->with('cursos', $cursos);
    }

    /**
     * Show the form for creating a new curso.
     *
     * @return Response
     */
    public function create()
    {
        $asesors = Asesor::pluck('name','id');
        return view('cursos.create',compact('asesors'));
    }

    /**
     * Store a newly created curso in storage.
     *
     * @param CreatecursoRequest $request
     *
     * @return Response
     */
    public function store(CreatecursoRequest $request)
    {
        $input = $request->all();

        $input['cover'] = "resources/welcome1.jpg";

        $curso = $this->cursoRepository->create($input);

        if($request->file('cover')){
            $path = Storage::disk('public')->put('covers',$request->file('cover'));
            $curso->fill(['cover'=>$path])->save();
        }

        Flash::success('Curso guardado.');

        return redirect(route('cursos.index'));
    }

    /**
     * Display the specified curso.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $curso = $this->cursoRepository->find($id);

        if (empty($curso)) {
            Flash::error('Curso no disponible');

            return redirect(route('cursos.index'));
        }

        return view('cursos.show')->with('curso', $curso);
    }

    /**
     * Show the form for editing the specified curso.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $asesors = Asesor::pluck('name','id');
        $curso = $this->cursoRepository->find($id);

        if (empty($curso)) {
            Flash::error('Curso no disponible');

            return redirect(route('cursos.index'));
        }

        return view('cursos.edit',compact('curso','asesors'));
    }

    /** 
     * Update the specified curso in storage.
     *
     * @param int $id
     * @param UpdatecursoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecursoRequest $request)
    {
        $curso = $this->cursoRepository->find($id);        

        if (empty($curso)) {
            Flash::error('Curso no disponible');

            return redirect(route('cursos.index'));
        }

        $curso = $this->cursoRepository->update($request->all(), $id);

       if($request->file('cover')){
            $path = Storage::disk('public')->put('covers',$request->file('cover'));
            $curso->fill(['cover'=>$path])->save();
        }

        Flash::success('Curso actualizado.');

        return redirect(route('cursos.index'));
    }

    /**
     * Remove the specified curso from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $curso = $this->cursoRepository->find($id);

        if (empty($curso)) {
            Flash::error('Curso not found');

            return redirect(route('cursos.index'));
        }

        $this->cursoRepository->delete($id);

        Flash::success('Curso eliminado.');

        return redirect(route('cursos.index'));
    }

    /* Displat with ajax */


    public function inicio(Request $request)
    {
        $perfil['perfil'] = Auth::user()->roles()->pluck('name')['0'];        
        $cursos;

        if($perfil['perfil'] == "Asesor"){
            $cursos = $this->cursoRepository->findWherePaginate("asesor_id","=",Auth::user()->asesor()->get()['0']->id,12);
        }else{
            $cursos = Auth::user()->estudiante()->get()['0']->cursos()->orderBy("pivot_updated_at","DESC")->paginate(12);            
        }

        //Flash::success('No tienes cursos registrados.');       

        $view = \View::make('cursos.inicioc')->with('cursos',$cursos);

        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }
        
        return $view;
    }

     public function showCurso($id)
    {        
        $perfil['perfil'] = Auth::user()->roles()->pluck('name')['0'];
        $curso = Curso::find($id);

        if (empty($curso)) {
            Flash::success('Curso no registrado.');
           return redirect()->route('inicio');
        }

        if($perfil['perfil'] == "Asesor"){
            if(!$curso->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
                Flash::success('Curso no registrado.');
                return redirect()->route('inicio');
            }    
        }else{
            if(!$curso->hasMatriculado(Auth::user()->estudiante()->get()['0']->id)){
                Flash::success('Curso no registrado.');
                return redirect()->route('inicio');
            }   
        }

         return view('scurso')->with('curso',$curso);
    }

     public function storea(Request $request)
    {
        $perfil['perfil'] = Auth::user()->roles()->pluck('name')['0'];

        if(!$perfil['perfil'] == "Asesor"){
            return redirect(route('inicio'));
        }

        $input =  [];
        $input['title'] = "Nombre de curso";
        $input['cover'] = "covers/erxDp0dMXQyPz8hYuLLUKj2gk9FlBrhrq06DyLtx.png";
        $input['review'] = "Breve mensaje";
        $input['asesor_id'] = Auth::user()->asesor()->get()['0']->id;
        $input['password'] = Str::random(10);

        $curso = $this->cursoRepository->create($input);

        Flash::success('Curso creado.');

        return redirect(route('inicio'));
    }

    public function updatea($id, UpdatecursoRequest $request)
    {        
        $curso = $this->cursoRepository->find($id);        

        if (empty($curso)) {
           abort(404,'Curso no disponible');
        }

        if(!$curso->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
                Flash::success('Curso no registrado.');
                return redirect()->route('inicio');
        } 

        $curso = $this->cursoRepository->update($request->all(), $id);

       if($request->file('cover')){
            $path = Storage::disk('public')->put('covers',$request->file('cover'));
            $curso->fill(['cover'=>$path])->save();
        }

        Flash::success('Curso actualizado.');

        $view = \View::make('scurso')->with('curso',$curso);

        $sections = $view->renderSections();
            
        return Response::json($sections['content']);
    }

    public function updatecover($id, Request $request)
    {
        $curso = $this->cursoRepository->find($id);        

        if (empty($curso)) {
            Flash::error('Curso not found');

            abort(403,'error no disponible');
        }

        if(!$curso->hasPropiedad(Auth::user()->asesor()->get()['0']->id)){
                Flash::success('Curso no registrado.');
                return redirect()->route('inicio');
            } 

       if($request->file('cover')){
            $path = Storage::disk('public')->put('covers',$request->file('cover'));
            $curso->fill(['cover'=>$path])->save();
        }

        Flash::success('Imagen actualizada.');

        $view = \View::make('scurso')->with('curso',$curso);

        $sections = $view->renderSections();
            
        return Response::json($sections['content']);
    }

    public function destroya($id)
    {
        $curso = $this->cursoRepository->find($id);

        if (empty($curso)) {
            Flash::error('Curso not found');

            abort(404,'Anuncio no disponible');
        }

        $this->cursoRepository->delete($id);

        Flash::success('Curso eliminado.');

       return Response()->json([ 'Curso' => 'Eliminado']);
    }

    /**/

    public function matricular(Request $request){

        $perfil['perfil'] = Auth::user()->roles()->pluck('name')['0'];

        if(!($perfil['perfil'] == "Asesor")){
            $curso = $this->cursoRepository->findwhere("password","=",$request->title)['0'];


            if (empty($curso)) {
                Flash::error('Curso no encontrado');
                return redirect(route('inicio'));  
            }
            
            if(!$curso->hasMatriculado(Auth::user()->estudiante()->get()['0']->id)){
                               
                $datos["curso_id"] = $curso->id;
                $datos["estudiante_id"] = Auth::user()->estudiante()->get()['0']->id;
                $matricula = $this->matriculadoRepository->create($datos);

                Flash::success('Curso registrado.');

                return redirect(route('inicio'));     
            }   

            Flash::success('Curso existente');
            
            return redirect(route('inicio'));     

        }
        
        return redirect(route('inicio'));            
    }
}
