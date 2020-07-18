<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\cursoRepository;
use App\Repositories\fdiscusionRepository;
use App\Repositories\fcategoriaRepository;
use App\Repositories\fpostRepository;
use Illuminate\Support\Facades\Auth;
use App\Repositories\AsesorRepository;
use App\Repositories\EstudianteRepository;

use App\Http\Controllers\AppBaseController;

use App\Models\fdiscusion;
use App\Models\fpost;
use Flash;
Use Response;
class ForumController extends Controller
{    

    private $cursoRepository;
    private $fdiscusionRepository;
    private $fcategoriaRepository;
    private $fpostRepository;

    public function __construct(CursoRepository $cursoRepo,fdiscusionRepository $fdiscusionRepo,fcategoriaRepository $fcategoriaRepo,fpostRepository $fpostRepos)
    {
        $this->cursoRepository = $cursoRepo;
        $this->fdiscusionRepository = $fdiscusionRepo;
        $this->fcategoriaRepository = $fcategoriaRepo;
        $this->fpostRepository = $fpostRepos;
        $this->middleware('auth');
    }

    public function foro($cur,Request $request)
    {        
        $curso = $this->cursoRepository->find($cur,['id','title','cover']);
        $categorias = $this->fcategoriaRepository->all([],null,null,['id','name','color']);
        $discuss;    
        if (!$request["en"] == "") {
            $discuss = $discuss->where("nameCategoria",$request["en"]);
        }else{
             $discuss = fdiscusion::query()
        ->withCategoria()
        ->withCategoriaColor()
        ->withUSer()
        ->withCurso($cur)
        ->orderBy('updated_at','DESC')
        ->get()
        ;
        }

        $view = \View::make('forum.content')->with(compact('curso','categorias','discuss'));

        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }
        
        return $view;
    }

     public function store($id,Request $request)
    {
        $input = $request->all();
        $input["curso_id"] = $id;
        $input["user_id"] = Auth::user()->id;
        $input["views"] = 0;
        $input["answered"] = 0;

        $fdiscusion = $this->fdiscusionRepository->create($input);

        Flash::success('Discusion creada');

        return redirect()->back();
    }

    public function show($cur,$id,Request $request){

         $curso = $this->cursoRepository->find($cur,['id','title','cover']);
         $curso['back'] = "foro/";

         $user = Auth::user()->id;

          $discuss = fdiscusion::query()
        ->withCategoria()
        ->withCategoriaColor()
        ->withUSer()
        ->where("id","=",$id)
        ->get()[0];

        $discuss['propiedad'] = $discuss->hasPropiedad($user);        

        $fposts = fpost::query()
        ->withDiscuss($id)
        ->withUser()
        ->withImage()
        ->get();

        foreach($fposts as $post){
            $post["propiedad"] =  $post->hasPropiedad($user);

        }

        $categorias= $this->fcategoriaRepository->all();
        $view = \View::make('forum.show')->with(compact('curso','discuss','fposts','categorias'));

        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }
        
        return $view;
    }


     public function comentar($id,Request $request)
    {

        $input = $request->all();
        $input["fdiscusion_id"] = $id;
        $input["user_id"] = Auth::user()->id;
        $input["locked"] = 0;

        $fpost = $this->fpostRepository->create($input);

        Flash::success('comentado');

        return redirect()->back();//apuntar comentario con back registrado
    }    
   

    public function discusion($id,$discusion)
    {
        
        $data = $this->fdiscusionRepository->find($discusion);

        if($data->hasPropiedad(Auth::user()->id) == 1 ){
            return $data;
        }

        return redirect()->back();
    }

     public function comentario($id,$comentario)
    {
        
        $data = $this->fpostRepository->find($comentario);

        if($data->hasPropiedad(Auth::user()->id) == 1 ){
            return $data;
        }

        return redirect()->back();
    }


     public function updated($id,Request $request)    
    {
        $input = $request->all();
        $fdiscusion = $this->fdiscusionRepository->find($id);

        if (empty($fdiscusion)) {
            Flash::error('tema  no encontrado');

            return redirect()->back();
        }

        if($fdiscusion->hasPropiedad(Auth::user()->id )  == 1){
            Flash::success('Actualizado.');
            $fdiscusion = $this->fdiscusionRepository->update($request->all(), $id);   
        }                

        return redirect()->back();
    }

      public function updateco($id, Request $request)
    {

        $input = $request->all();     
        
        $fpost = $this->fpostRepository->find($input["comentario"]);

        if (empty($fpost)) {
            Flash::error('contenido no encontrado');
            return redirect()->back();
        }

        if($fpost->hasPropiedad(Auth::user()->id )  == 1){
            Flash::success('Actualizado.');
            $fpost = $this->fpostRepository->update($input, $input["comentario"]);   
        }                

        return redirect()->back();
    }


}

