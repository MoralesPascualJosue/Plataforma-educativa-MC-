<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

use App\Models\Anuncio;

class HomeController extends Controller
{
    /**we
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $anuncios = Anuncio::all()->sortBy('updated_at' ,SORT_REGULAR , true);

        $view = \View::make('home')->with('anuncios',$anuncios);

        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }

        return $view;
    }
    
}
