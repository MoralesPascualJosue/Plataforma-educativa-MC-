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

        $contacts = $this->cursoRepository
        ->find($cur)
        ->estudiantes()
        ->withUser()
        ->get();        

        $view = \View::make('chat.content')->with(compact('curso','chats','contacts','user'));

        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }
        
        return $view;
    }

     public function chat($cur,$u,Request $request)
    {
        /*
            $cur usuairo_id
         */

        $chats = Auth::user()->chats()->where('curso_id',$cur)
        ->get();
        
        foreach($chats as $ca){
            if($ca->participante($u) == 1){
                 $data['chat'] = $ca;
                 $data['i'] = Auth::user()->id;
                 $data['messages'] = $ca->messages()->withUser()->withImage()->get();
                return $data;   
            }         
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

        return $data;
    }

     public function chatC($cur,$u,Request $request)
    {

        $data['chat'] = Chat::find($u);
        if(empty($data['chat'])){
            abort(404,'mal uso');
        }
        $data['i'] = Auth::user()->id;
        $data['messages'] = $data['chat']->messages()->withUser()->withImage()->get();

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

    
}
