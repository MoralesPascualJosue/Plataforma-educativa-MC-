<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAnuncioRequest;
use App\Http\Requests\UpdateAnuncioRequest;
use App\Repositories\AnuncioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\User;
use Illuminate\Support\Facades\Auth;

class AnuncioController extends AppBaseController
{
    private $anuncioRepository;

    public function __construct(AnuncioRepository $anuncioRepo)
    {
        $this->anuncioRepository = $anuncioRepo;
    }

    public function storea(CreateAnuncioRequest $request)
    {        

        $input = $request->all();

        $input['user_id'] = Auth::user()->id;

        $anuncio = $this->anuncioRepository->create($input);
        
        Flash::success('Anuncio publicado.');     

        $anuncios = $this->anuncioRepository->all()->sortBy('updated_at' ,SORT_REGULAR , true);;

         $view = \View::make('anuncios.showanuncios')->with('anuncios',$anuncios);
        
        return $view;
    }


    public function destroya($id)
    {
        $anuncio = $this->anuncioRepository->find($id);

        if (empty($anuncio)) {
            abort(404,'Anuncio no disponible');
        }

        $this->anuncioRepository->delete($id);

        Flash::success('Anuncio eliminado.');

        $anuncios = $this->anuncioRepository->all()->sortBy('updated_at' ,SORT_REGULAR , true);

        $view = \View::make('anuncios.showanuncios')->with('anuncios',$anuncios);
        
        return $view;
    }

     public function updatea($id, UpdateAnuncioRequest $request)
    {
        $anuncio = $this->anuncioRepository->find($id);

        if (empty($anuncio)) {
            abort(404,'Anuncio no disponible');
        }

        $input = $request->all();

        $input['user_id'] = Auth::user()->id;

        $anuncio = $this->anuncioRepository->update($input, $id);

       Flash::success('Anuncio actualizado.');

        $anuncios = $this->anuncioRepository->all()->sortBy('updated_at' ,SORT_REGULAR , true);

        $view = \View::make('anuncios.showanuncios')->with('anuncios',$anuncios);
        
        return $view;
    }

}
