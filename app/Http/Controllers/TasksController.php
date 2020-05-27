<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tasks\Tasks;

class TasksController extends Controller
{
    //
    public function getAll(){
        $tasks = Tasks::all();
        return $tasks;
    }

    public function add(Request $request){
        $tasks = Tasks::create($request->all());
        return $tasks;
    }
}
