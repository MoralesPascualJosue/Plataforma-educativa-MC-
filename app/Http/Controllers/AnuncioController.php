<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAnuncioRequest;
use App\Http\Requests\UpdateAnuncioRequest;
use App\Repositories\AnuncioRepository;

use App\User;
use Illuminate\Support\Facades\Auth;

class AnuncioController extends Controller
{
    private $anuncioRepository;

    public function __construct(AnuncioRepository $anuncioRepo)
    {
        $this->anuncioRepository = $anuncioRepo;
        $this->middleware('auth');
    }

    public function storea(CreateAnuncioRequest $request)
    {        
        if (Auth::user()->cannot("edit cursos")) {
            return "No disponible";     
        }
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $anuncio = $this->anuncioRepository->create($input);

        if($request->ajax()){
            return $anuncio;
        }
        
        return "No disponible";
    }

    public function destroya($id)
    {

        if (Auth::user()->cannot("edit cursos")) {
            return "No disponible";     
        }

        $anuncio = $this->anuncioRepository->find($id);

        if (empty($anuncio)) {
            abort(404,'Anuncio no disponible');
        }

        $this->anuncioRepository->delete($id);
        
        return "Anuncio eliminado";
    }

     public function updatea($id, UpdateAnuncioRequest $request)
    {
        if (Auth::user()->cannot("edit cursos")) {
            return "No disponible";     
        }

        $anuncio = $this->anuncioRepository->find($id);

        if (empty($anuncio)) {
            abort(404,'Anuncio no disponible');
        }

        $input = $request->all();

        $input['user_id'] = Auth::user()->id;

        $anuncio = $this->anuncioRepository->update($input, $id);

        if($request->ajax()){
            return $anuncio;
        }
        
        return "No disponible";
    }

}
