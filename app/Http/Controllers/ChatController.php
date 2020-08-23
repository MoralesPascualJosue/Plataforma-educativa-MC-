<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Flash;
use Response;

use App\Repositories\cursoRepository;
use App\User;
use App\Models\Curso;
use App\Models\Message;
use App\Models\user_message;


class ChatController extends Controller
{    
    private $cursoRepository;

      public function __construct(CursoRepository $cursoRepo)
    {
        $this->cursoRepository = $cursoRepo;
        $this->middleware('auth');
    }

     public function mensajes($cur,Request $request)
    {       
        $usero = Auth::user(); 
        $user = User::find($usero->id,["name","email","image"]);
        $curso = $this->cursoRepository->find($cur,['id','title','cover']);     
        $chats = [];

        if($usero->can('edit cursos')){
            $user['perfil'] = $usero->asesor()->get()[0];
        }else{
            $user['perfil'] = $usero->estudiante()->get()[0];
        }

        $chats = $usero->mensages()->withUser()->orderBy("created_at","DESC")->where('curso_id',$cur)->get();

        $contacts = $this->cursoRepository
        ->find($cur)
        ->estudiantes()
        ->withUser()
        ->get(["user_id","name"]);      

        $contacts[] = $this->cursoRepository
        ->find($cur)
        ->asesor()
        ->withUser()
        ->first(["user_id","name"]);

        $enviados = $usero->messages()->withUser()->orderBy("created_at","DESC")->where('curso_id',$cur)->get();

        if($request->ajax()){
            // $sections = $view->renderSections();
            // return Response::json($sections['content']);
            $data["enviado"] = $enviados;
            $data["chats"] =$chats;
            $data["contacts"] = $contacts;
            $data["user"] = $user;

            return $data;
        }

        $view = \View::make('chat.show')->with(compact('curso','chats','contacts','user'));
        
        return $view;
    }

     public function send($cur,Request $request)
    {
        $input = $request->all();        
        $input['send'] =  Auth::user()->id;
        $input['reader'] = 0;
        $input['curso_id'] = $cur;
        $curso = $this->cursoRepository->find($cur);
        $llave = false;        
        
        if($curso->hasPropiedad($input["send"])) {
            $llave = true;
        }else{
            $estudiante = Auth::user()->estudiante()->get()[0];

            if ($curso->hasMatriculado($estudiante->id)) {
                $llave = true;
            }
        }

         if(!$llave){
            abort(404,"Permisos insuficientes");    
         }

        if(empty($input["destino"])){
            abort(404,"Sin envio");
        }

        if(empty($input["asunto"])){
            abort(404,"Sin asunto");
        }

        $message = Message::create($input);
       
        foreach($input["destino"] as $destino){
            $in['user_id'] = $destino;
            $in['message_id'] = $message->id;
            $in['news'] = 0;

            user_message::create($in);    
        }             

        $message["user"] = User::where("id",$message["send"])->get(["name","image"])[0];

        return $message;
    }

     public function chatC($cur,$u,Request $request)
    {
        $message = Message::withUser()->orderby("id","DESC")->where("id",$u)->get(); 

        if(empty($message[0])){
            abort(404,'Contenido no disponible');
        }

        $message[0]["destino"] = Message::find($u)->users()->get(["name","email"]);
        $message[0]["cursoName"] = Curso::where("id",$message[0]["curso_id"])->first(["title"]);
        
        return $message[0];
    }

    public function destroyc($id)
    {   

        $menssage = Message::find($id);

        if(empty($menssage)){
            abort(404,"Contenido no disponible");
        }

        if (!$menssage->hasPropiedad(Auth::user()->id)) {
            $destino= user_message::where("message_id",$menssage->id)->where("user_id",Auth::user()->id);
            $destino->delete();
            return "eliminado";
        }        
        $destinos = user_message::where("message_id",$menssage->id)->get();
        
        foreach($destinos as $destino){
            $destino->delete();
        }

        $menssage->delete();

        return "eliminado -";
    }

    public function updatems($cur)
    {
        $usero = Auth::user();  
        $chats = $usero->mensages()->withUser()->orderBy("created_at","DESC")->where('curso_id',$cur)->get();
        return $chats;
    }

    public function enviadosms($cur)
    {
        $usero = Auth::user();  
        $chats = $usero->messages()->withUser()->orderBy("created_at","DESC")->where('curso_id',$cur)->get();
        return $chats;
    }
}