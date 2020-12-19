<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repositories\fdiscusionRepository;
use App\Repositories\fcategoriaRepository;
use App\Repositories\fpostRepository;

use App\Models\fdiscusion;
use App\Models\fcategoria;
use App\Models\fpost;

class ForumController extends Controller
{    

    private $fdiscusionRepository;
    private $fcategoriaRepository;
    private $fpostRepository;

    public function __construct(fdiscusionRepository $fdiscusionRepo,fcategoriaRepository $fcategoriaRepo,fpostRepository $fpostRepos)
    {
        $this->fdiscusionRepository = $fdiscusionRepo;
        $this->fcategoriaRepository = $fcategoriaRepo;
        $this->fpostRepository = $fpostRepos;
        $this->middleware('auth');
    }

    public function foro($cur,Request $request)
    {        
        $categorias = fcategoria::orderby("updated_at","DESC")->get(['id','name','color']);

        $discuss = fdiscusion::query()->withCategoria()->withCategoriaColor()
        ->withUSer()
        ->withCurso($cur)
        ->orderBy('updated_at','DESC')
        ->get();

        if($request->ajax()){
            $data["categorias"] = $categorias;
            $data["discuss"] = $discuss;
            return $data;
        }
        
        return "No disponible";
    }

     public function store($id,Request $request)
    {

        $cate = "";
        $input = $request->all();
        
        if ($input["title"] == "") {
            abort(404,"Campos vacios");
        }

        if ($input["nuevacategoria"] == "nuevasi" ) {
            if ($input["categoria"] == "" ){
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
        $fdiscusion->nameCategoria = $cate->name;

        if($request->ajax()){        
            $data["discusion"] = $fdiscusion;
            $data["categoria"] = $cate;
            return $data;
        }

        return "No disponible";
    }

    public function show($cur,$id,Request $request){

         $user = Auth::user()->id;
         $discuss = fdiscusion::find($id);
         
         if (empty($discuss)) {
             return "No disponible";
         }

        $discuss = fdiscusion::query()->withCategoria()->withCategoriaColor()
        ->withUSer()
        ->where("id","=",$id)
        ->get()[0];        

        $discuss['propiedad'] = $discuss->hasPropiedad($user);

        $fposts = fpost::query()->withDiscuss($id)
        ->withUser()
        ->withImage()
        ->get();

        foreach($fposts as $post){
            $post["propiedad"] =  $post->hasPropiedad($user);
        }

        $categorias= $this->fcategoriaRepository->all();        

        if($request->ajax()){
            $data["fpost"] = $fposts;            
            $data["discuss"] = $discuss["propiedad"];
            return $data;
        }
        
        return "No disponible";
        
    }

     public function comentar($id,Request $request)
    {

        $input = $request->all();

        if ($input["body"] == "") {
            abort(404,"Comentario vacio");
        }

        $input["fdiscusion_id"] = $id;
        $input["user_id"] = Auth::user()->id;
        $input["locked"] = 0;

        $fpost = $this->fpostRepository->create($input);

        $fdiscusion = $this->fdiscusionRepository->find($id);
        $inputd["answered"] = $fdiscusion["answered"]+1;
        $this->fdiscusionRepository->update($inputd, $id);

        $fcomentario = fpost::query()->withDiscuss($id)
        ->withUser()
        ->withImage()
        ->where("id","=",$fpost->id)
        ->get()["0"];

        if($request->ajax()){
            $fcomentario["propiedad"] = 1;
            return $fcomentario;
        }

        return "No disponible";
    }    

     public function updated($id,Request $request)    
    {
        $input = $request->all();
        
        if ($input["title"] == "") {
            abort(404,"Tema vacio");
        }

        $input["body"] = "";
        $fdiscusion = $this->fdiscusionRepository->find($id);

        if (empty($fdiscusion)) {
            abort(404,"No disponible");
        }

        if($fdiscusion->hasPropiedad(Auth::user()->id )  == 1){
            $fdiscusion = $this->fdiscusionRepository->update($input, $id);   
        }     

         $discuss = fdiscusion::query()->withCategoria()->withCategoriaColor()
        ->withUSer()
        ->where("id","=",$id)
        ->get()[0];

        if($request->ajax()){
            return $discuss;
        }

        return "No disponible";
    }

      public function updateco($id, Request $request)
    {

        $input = $request->all();   
        
        if ($input["body"] == "") {
            abort(404,"Comentario vacio");
        }
        
        $fpost = $this->fpostRepository->find($id);

        if (empty($fpost)) {
            abort(404,"No disponible");
        }

        if($fpost->hasPropiedad(Auth::user()->id )  == 1){
            $fpost = $this->fpostRepository->update($input, $id);   
        }                

         $comentario = fpost::query()->withUser()->withImage()
        ->where("id",$id)
        ->get()[0];

        if($request->ajax()){
            $comentario["propiedad"] = 1;
            return $comentario;
        }

        return "No disponibe";
    }

     public function deleteco($curso,$id)
    {
        
        $fpost = $this->fpostRepository->find($id);

        if (empty($fpost)) {
            abort(404,"Contenido no dispinible");
        }

        if($fpost->hasPropiedad(Auth::user()->id )  == 1){
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
           abort(404,"Contenido no disponible");
        }        

        if($fdiscusion->hasPropiedad(Auth::user()->id )  == 1){;
            $posts = $fdiscusion ->posts()->get();
            
            foreach($posts as $post){
             $post->delete();
            }

            $this->fdiscusionRepository->delete($id);
            return "Eliminado";
        }                

        return "Contenido no disponible";
    }

}

