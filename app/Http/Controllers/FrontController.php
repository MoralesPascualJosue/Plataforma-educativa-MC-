<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

use App\Repositories\AsesorRepository;
use App\Repositories\EstudianteRepository;
use Illuminate\Support\Facades\Storage;
use Flash;

class FrontController extends Controller
{
    
    /** @var  AsesorRepository
     *  @var  EstudianterRepository 
     */

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
         
        $perfil['perfil'] = Auth::user()->roles()->pluck('name')['0'];
        $user;

        if($perfil['perfil'] == "Asesor"){
                $user = $this->asesorRepository->findwhere("user_id","=",Auth::user()->id)->first();
        }else{
            $user = $this->estudianteRepository->findwhere("user_id","=",Auth::user()->id)->first();  
        }

        if (empty($user)) {
            Flash::error('Usuario no disponible');
            abort(403,'error no disponible');
        }

        $view = \View::make('perfil')->with('perfil',$user);

        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }
        
        return $view;
    }

     public function updatePerfil(Request $request)
    {    
         
        $perfil['perfil'] = Auth::user()->roles()->pluck('name')['0'];
        $user;
        if(!is_numeric($request['telephone'])){
            $request['telephone'] = 0;
        }

        if($perfil['perfil'] == "Asesor"){
             $user = $this->asesorRepository->findwhere("user_id","=",Auth::user()->id)->first();
        }else{
            $user = $this->estudianteRepository->findwhere("user_id","=",Auth::user()->id)->first();
        }
        
        if (empty($user)) {
            Flash::error('Usuario no disponible');

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
            $user->fill(['image'=>asset($path)])->save();
        }      

        Flash::success('Perfil actualizado.');

        $view = \View::make('perfil')->with('perfil',$user);

        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }
        
        return $view;

    }

    public function updateimage(Request $request)
    {

        $perfil['perfil'] = Auth::user()->roles()->pluck('name')['0'];
        $userb = Auth::user();
        $user;

        if($perfil['perfil'] == "Asesor"){
            $user = $this->asesorRepository->findwhere("user_id","=",Auth::user()->id)->first();
        }else{
            $user = $this->estudianteRepository->findwhere("user_id","=",Auth::user()->id)->first();
        }        

        if (empty($user)) {
            Flash::error('Usuario no disponible');
            abort(403,'error no disponible');
        }

       if($request->file('image')){
            $path = Storage::disk('public')->put('photos',$request->file('image'));
            $user->fill(['image'=>$path])->save();
            $userb->fill(['image'=>$path])->save();
        }


        Flash::success('Imagen actualizada.');

        $view = \View::make('perfil')->with('perfil',$user);

        $sections = $view->renderSections();
            
        return Response::json($sections['content']);
    }

    public function leernotificaciones()
    {
        $miusuario = Auth::user()->estudiante()->get()[0];
        $miusuario->unreadNotifications->markAsRead();
        return redirect()->back();
    }

}
