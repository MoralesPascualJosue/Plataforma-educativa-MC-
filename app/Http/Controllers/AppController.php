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
        $anuncios = [];
        $perfil = Auth::user()->roles()->pluck('name')['0'];
        $anuncios = Anuncio::orderBy('updated_at','DESC')->get();

        if($request->ajax()){
            return $anuncios;
        }

        $view = \View::make('homevue')->with(compact('anuncios','perfil'));
        return $view;
    }
    
}
