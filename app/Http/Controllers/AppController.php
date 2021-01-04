<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Anuncio;

class AppController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $perfil = Auth::user()->roles()->pluck('name')['0'];        

        if($request->ajax()){
            $anuncios = Anuncio::orderBy('updated_at','DESC')->get();
            $user = Auth::user();
            $data["anuncios"] = $anuncios;
            $data["user"]["name"] = $user->name;
            $data["user"]["email"] = $user->email;
            $data["user"]["image"] = $user->image;

            return $data;
        }

        $view = \View::make('homevue')->with(compact('perfil'));
        return $view;
    }
    
}
