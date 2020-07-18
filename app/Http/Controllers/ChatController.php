<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\cursoRepository;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Message;
use App\Models\user_chat;
use Flash;
use Response;


class ChatController extends Controller
{
    //
    private $cursoRepository;

      public function __construct(CursoRepository $cursoRepo)
    {
        $this->cursoRepository = $cursoRepo;
        $this->middleware('auth');
    }

     public function chats($cur,Request $request)
    {       
        $user = Auth::user(); 
        if($user->can('edit cursos')){
            $user['perfil'] = $user->asesor()->get()[0];
        }else{
            $user['perfil'] = $user->estudiante()->get()[0];
        }

        $curso = $this->cursoRepository->find($cur,['id','title','cover']);     

        $chats = Auth::user()->chats()->where('curso_id',$cur)->get();

        foreach($chats as $ca){
            $ca->last = $ca->messages()->orderBy("id","DESC")->first();
        }

        $contacts = $this->cursoRepository
        ->find($cur)
        ->estudiantes()
        ->withUser()
        ->get();        

        $view = \View::make('chat.show')->with(compact('curso','chats','contacts','user'));

        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }
        
        return $view;
    }

     public function chat($cur,$u,Request $request)
    {

        $chats = Auth::user()->chats()->where('curso_id',$cur)
        ->get();        

        $inputm['send'] =  Auth::user()->id;
        $inputm['reader'] = 0;
        $inputm['body'] = $request['body'];
        $llave = false;
        
        foreach($chats as $ca){
            if($ca->participante($u) == 1 and $ca->users()->count() < 3){
                 $data['chat'] = $ca;
                 $data['i'] = Auth::user()->id;
                 $data['messages'] = $ca->messages()->withUser()->withImage()->get();
                 $data["state"] = "return";

                $inputm['chat'] = $ca->id;
                
                $message = Message::create($inputm);
                $llave = true;
            break;
            }         
        }

        if ($llave) {
            $mischats = Auth::user()->chats()->where('curso_id',$cur)->get();
            foreach($mischats as $ca){
                $ca->last = $ca->messages()->orderBy("id","DESC")->first();
            }     
            return $mischats;
        }                 
        

        $input['name'] = User::find($u)->name;
        $input['curso_id'] = $cur;

        $data['chat'] = Chat::create($input);
        $data['i'] = Auth::user()->id;
        $data['messages'] = [];        

        $in['user_id'] = $data['i'];
        $in['chat_id'] = $data['chat']->id;
        $in['news'] = 0;
        
        user_chat::create($in);

        $in['user_id'] = $u;

        user_chat::create($in);
        $data["state"] = "new";
        
        $inputm['chat'] = $data['chat']->id;;        
        $message = Message::create($inputm);

        $mischats = Auth::user()->chats()->where('curso_id',$cur)->get();
        foreach($mischats as $ca){
            $ca->last = $ca->messages()->orderBy("id","DESC")->first();
        }     
        return $mischats;
    }

     public function chatC($cur,$u,Request $request)
    {

        $data['chat'] = Chat::find($u);        
        if(empty($data['chat'])){
            abort(404,'mal uso');
        }
        $data['i'] = Auth::user()->id;
        $data['participantes'] = $data['chat']->users()->get(["user_id","name"]);
        $data['messages'] = $data['chat']->messages()->withUser()->withImage()->orderby("id","DESC")->get();

        return $data;
    }

    public function message($id,Request $request){        
        $input['chat'] = $id;
        $input['send'] =  Auth::user()->id;
        $input['reader'] = 0;
        $input['body'] = $request['body'];
        
        $message = Message::create($input);

        return "enviado";
    }

    public function destroyc($id)
    {   
        $chat = Chat::find($id);

        if (empty($chat)) {
            Flash::error('No disponible');

            abort(404,' no disponible');
        }

        if(!$chat->participante(Auth::user()->id)){
                Flash::success('No registrado.');
                return redirect()->route('inicio');
        }

        $participantes = user_chat::where("chat_id",$id)->get();
        
        foreach($participantes as $p){
            $p->delete();
        }
        
        $messages = $chat->messages()->get();
        foreach($messages as $m){
            $m->delete();
        }

        $chat->delete();

        Flash::success('Eliminado.');

       return Response()->json([ 'Chat' => 'chat']);
    }

    public function mischats(Request $request){

        $input = $request->all();
        $mischats=[];
        if (!$request["en"] == "") {
            $mischats = Auth::user()->chats()->where('curso_id',$input["en"])->get();
        }         
        foreach($mischats as $ca){
            $ca->last = $ca->messages()->orderBy("id","DESC")->first();
        }     
        return $mischats;
    }    

    public function agregate($c,Request $request)
    {
        $input = $request->all();

        if ($input["chat"] == 0) {
            return "no chat";
        }

        $chat = Chat::find($input["chat"]);
        
        if(empty($chat)){
            abort(404,'mal uso');
        }

        if($chat->participante(Auth::user()->id) == 0){
            abort(404,'mal uso');
        }

        if($chat->participante($input["participante"]) == 1){
            return "participante";
        }
        
        if ($chat->users()->count() < 3) {
            //crear chat

            $input['name'] = "Paticipantes chat";
            $input['curso_id'] = $chat->curso_id;

            $data['chat'] = Chat::create($input);    
            $data['participantes'] = $chat->users()->get();  

            foreach ($data["participantes"] as $participante) {
                $in['user_id'] = $participante["id"];
                $in['chat_id'] = $data['chat']->id;
                $in['news'] = 0;
                
                user_chat::create($in);    
            }

            $in['user_id'] = $input["participante"];
            $in['chat_id'] = $data["chat"]->id;
            $in['news'] = 0;
            
            user_chat::create($in);

            $d["event"] = "agregadoc";
            $d["chat"] = $data["chat"];
            return $d;
        }

        $in['user_id'] = $input["participante"];
        $in['chat_id'] = $input["chat"];
        $in['news'] = 0;
        
        user_chat::create($in);
        $d["event"] = "agregado";
        $d["participante"] = User::find($in["user_id"],"name");
        return $d;
    }
}
