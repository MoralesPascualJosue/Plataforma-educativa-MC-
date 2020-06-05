<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\cursoRepository;
use App\Repositories\fdiscusionRepository;
use App\Repositories\fcategoriaRepository;
use Illuminate\Support\Facades\Auth;
use App\Repositories\AsesorRepository;
use App\Repositories\EstudianteRepository;

use App\Http\Controllers\AppBaseController;

use App\Models\fdiscusion;
//use App\Models\fcategoria;

class ForumController extends Controller
{    

    private $cursoRepository;
    private $fdiscusionRepository;
    private $fcategoriaRepository;

    public function __construct(CursoRepository $cursoRepo,fdiscusionRepository $fdiscusionRepo,fcategoriaRepository $fcategoriaRepo)
    {
        $this->cursoRepository = $cursoRepo;
        $this->fdiscusionRepository = $fdiscusionRepo;
        $this->fcategoriaRepository = $fcategoriaRepo;
        $this->middleware('auth');
    }

    public function foro($cur,Request $request)
    {
        $curso = $this->cursoRepository->find($cur,['id','title','cover']);
        $categorias = $this->fcategoriaRepository->all([],null,null,['id','name','color']);

        //return $categorias;

        //return $curso;

        $discuss = fdiscusion::query()
        ->withCategoria()
        ->withCategoriaColor()
        ->withUSer()
        ->withCurso($cur)->get()
        ;

        //return $discuss;

        $view = \View::make('forum.content')->with(compact('curso','categorias','discuss'));

        if($request->ajax()){
            $sections = $view->renderSections();
            return Response::json($sections['content']);
        }
        
        return $view;
    }
}
