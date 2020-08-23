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
use App\Models\fcategoria;
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
        $categorias = fcategoria::orderby("updated_at","DESC")->get(['id','name','color']);
        $discusst = [];    
        $discuss = [];
        $back = "";

        if (!$request["en"] == "") {

             $discusst = fdiscusion::query()
        ->withCategoria()
        ->withCategoriaColor()
        ->withUSer()
        ->withCurso($cur)
        ->orderBy('updated_at','DESC')        
        ->get()
        ;

        $discuss = $discusst->where("nameCategoria",$request["en"]);
        $back = $request["en"];
        
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

        $view = \View::make('forum.content')->with(compact('curso','categorias','discuss','back'));

        if($request->ajax()){
            // $sections = $view->renderSections();
            // return Response::json($sections['content']);
            $data["curso"] = $curso;
            $data["categorias"] = $categorias;
            $data["discuss"] = $discuss;
            return $data;
        }
        
        return $view;
    }

     public function store($id,Request $request)
    {

        $cate = "";
        $input = $request->all();
        
        if ($input["title"] == "") {
            // Flash::success('Tema vacio');
            // return redirect()->back();
            abort(404,"Campos vacios");
        }

        if ($input["nuevacategoria"] == "nuevasi" ) {
            if ($input["categoria"] == "" ){
                //Flash::success('Nombre vacio');
                //return redirect()->back();
                abort(404,"campos vacios");
            }

            $inputc["name"] = $input["categoria"];
            $inputc["color"] = $input["color"];
            $cate = $this->fcategoriaRepository->create($inputc);
            $input["fcategoria"] = $cate->id;
        }else{
            $cate =  $this->fcategoriaRepository->find($input["fcategoria"]);
        }

        $input["curso_id"] = $id;
        $input["user_id"] = Auth::user()->id;
        $input["views"] = 0;
        $input["answered"] = 0;
        $input["body"] = "";

        $fdiscusion = $this->fdiscusionRepository->create($input);
        $fdiscusion->colorCategoria = $cate->color;

        if($request->ajax()){        
            $data["discusion"] = $fdiscusion;
            $data["categoria"] = $cate;
            return $data;
        }

        Flash::success('Discusion creada');

        return redirect()->back();
    }

    public function show($cur,$id,Request $request){

         $curso = $this->cursoRepository->find($cur,['id','title','cover']);
         $curso['back'] = $request["back"];

         $user = Auth::user()->id;

         $discuss = fdiscusion::find($id);
         if (empty($discuss)) {
             return redirect()->back();
         }

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
            // $fdiscusion = $this->fdiscusionRepository->find($id);
            // $input["views"] = $fdiscusion["views"]+1;
            // $this->fdiscusionRepository->update($input, $id);

            // $sections = $view->renderSections();
            // return Response::json($sections['content']);
            $data["fpost"] = $fposts;            
            $data["discuss"] = $discuss["propiedad"];
            return $data;
        }
        
        return $view;
        
    }


     public function comentar($id,Request $request)
    {

        $input = $request->all();

        if ($input["body"] == "") {
            Flash::success('Comentario vacio');

            //return redirect()->back();
            abort(404,"Comentario vacio");
        }

        $input["fdiscusion_id"] = $id;
        $input["user_id"] = Auth::user()->id;
        $input["locked"] = 0;

        $fpost = $this->fpostRepository->create($input);

        $fdiscusion = $this->fdiscusionRepository->find($id);
        $inputd["answered"] = $fdiscusion["answered"]+1;
        $this->fdiscusionRepository->update($inputd, $id);

        Flash::success('comentado');

        $fcomentario = fpost::query()
        ->withDiscuss($id)
        ->withUser()
        ->withImage()
        ->where("id","=",$fpost->id)
        ->get()["0"];

        if($request->ajax()){
            $fcomentario["propiedad"] = 1;
            return $fcomentario;
        }

        return redirect()->back();
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
        
        if ($input["title"] == "") {
            Flash::success('Tema vacio');

            return redirect()->back();
        }

        $input["body"] = "";
        $fdiscusion = $this->fdiscusionRepository->find($id);

        if (empty($fdiscusion)) {
            Flash::error('tema  no encontrado');
            abort(404,"No disponible");
        }

        if($fdiscusion->hasPropiedad(Auth::user()->id )  == 1){
            Flash::success('Actualizado.');
            $fdiscusion = $this->fdiscusionRepository->update($input, $id);   
        }     

         $discuss = fdiscusion::query()
        ->withCategoria()
        ->withCategoriaColor()
        ->withUSer()
        ->where("id","=",$id)
        ->get()[0];
        if($request->ajax()){
            return $discuss;
        }


        return "error";
    }

      public function updateco($id, Request $request)
    {

        $input = $request->all();   
        
          if ($input["body"] == "") {
            Flash::success('Comentario vacio');

            return redirect()->back();
        }
        
        $fpost = $this->fpostRepository->find($id);

        if (empty($fpost)) {
            Flash::error('contenido no encontrado');
            return redirect()->back();
        }

        if($fpost->hasPropiedad(Auth::user()->id )  == 1){
            Flash::success('Actualizado.');
            $fpost = $this->fpostRepository->update($input, $id);   
        }                

         $comentario = fpost::query()
        ->withUser()
        ->withImage()
        ->where("id",$id)
        ->get()[0];
        if($request->ajax()){
            $comentario["propiedad"] = 1;
            return $comentario;
        }

        return redirect()->back();
    }

     public function deleteco($curso,$id)
    {
        
        $fpost = $this->fpostRepository->find($id);

        if (empty($fpost)) {
            abort(404,"Contenido no dispinible");
        }

        if($fpost->hasPropiedad(Auth::user()->id )  == 1){
            Flash::success('Eliminado.');
            $this->fpostRepository->delete($id);
            
            $fdiscusion = $this->fdiscusionRepository->find($fpost->fdiscusion_id);
            $input["answered"] = $fdiscusion["answered"]-1;
            $this->fdiscusionRepository->update($input, $fpost->fdiscusion_id);
            
            return "Eliminado";
        }                

        return "Contenido no disponible";
    }

     public function deletedis($curso,$id)
    {
        
        $fdiscusion = $this->fdiscusionRepository->find($id);        

        if (empty($fdiscusion)) {
        //       Flash::success('Contenido no disponible.');
        //    return redirect()->route('foro',$curso);
           abort(404,"Contenido no disponible");
        }        

        if($fdiscusion->hasPropiedad(Auth::user()->id )  == 1){;
            $posts = $fdiscusion ->posts()->get();
            foreach($posts as $post){
             $post->delete();
            }
            $this->fdiscusionRepository->delete($id);
            return "Eliminado";
        //     Flash::success('Contenido eliminado.');
        //    return redirect()->route('foro',$curso);
        }                

        return "Contenido no disponible";
    }

}

