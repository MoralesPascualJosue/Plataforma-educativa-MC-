<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repositories\AsesorRepository;
use App\Repositories\EstudianteRepository;
use Illuminate\Support\Facades\Storage;

class FrontController extends Controller
{

    private $asesorRepository;    
    private $estudianteRepository;

    public function __construct(AsesorRepository $asesorRepo, EstudianteRepository $estudianteRepo)
    {
        $this->asesorRepository = $asesorRepo;
        $this->estudianteRepository = $estudianteRepo;
        $this->middleware('auth');
    }
    
    public function perfil(Request $request)
    {    
        $user;
        $perfil['perfil'] = Auth::user()->roles()->pluck('name')['0'];        

        if($perfil['perfil'] == "Asesor"){
            $user = $this->asesorRepository->findwhere("user_id","=",Auth::user()->id)->first();
        }else{
            $user = $this->estudianteRepository->findwhere("user_id","=",Auth::user()->id)->first();  
        }

        if (empty($user)) {
            abort(404,'No disponible');
        }

        if($request->ajax()){
            $data["perfil"] = $user;
            $data["user"] = Auth::user();
            return $data;
        }
        
        return "No disponible";
    }

     public function updatePerfil(Request $request)
    {    
        $user;
        $perfil['perfil'] = Auth::user()->roles()->pluck('name')['0'];        

        if($perfil['perfil'] == "Asesor"){
            $user = $this->asesorRepository->findwhere("user_id","=",Auth::user()->id)->first();
        }else{
            $user = $this->estudianteRepository->findwhere("user_id","=",Auth::user()->id)->first();
        }
        
        if (empty($user)) {
            abort(404,"Accion no disponible");
        }

        if($perfil['perfil'] == "Asesor"){
            $user = $this->asesorRepository->update($request->all(), $user->id);  
        }else{
            $user = $this->estudianteRepository->update($request->all(), $user->id);  
        }

        $input["name"] = $request["name"];

        Auth::user()->update($input);
        
        if($request->file('image')){
            $path = Storage::disk('public')->put('photos',$request->file('image'));
            Auth::user()->fill(['image'=>asset($path)])->save();
        }      

        if($request->ajax()){
            $data["perfil"] = $user;
            $data["user"] = Auth::user();

            return $data;
        }
        
        return "No disponible";
    }

    public function leernotificaciones()
    {
        $miusuario = Auth::user()->estudiante()->get()[0];
        $miusuario->unreadNotifications->markAsRead();
        return "Notificaciones leidas";
    }

}
