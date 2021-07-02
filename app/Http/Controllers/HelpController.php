<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    //
    public function help(){
        $perfil = "Help";
        $view = \View::make('homevue')->with(compact('perfil'));
        return $view;
    }
}
