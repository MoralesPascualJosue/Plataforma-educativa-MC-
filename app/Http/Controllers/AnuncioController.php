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
    /** @var  AnuncioRepository */
    private $anuncioRepository;

    public function __construct(AnuncioRepository $anuncioRepo)
    {
        $this->anuncioRepository = $anuncioRepo;
    }

    /**
     * Display a listing of the Anuncio.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $anuncios = $this->anuncioRepository->all();

        return view('anuncios.index')
            ->with('anuncios', $anuncios);
    }

    /**
     * Show the form for creating a new Anuncio.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::pluck('name','id');
        return view('anuncios.create',compact('users'));
    }


    /**
     * Store a newly created Anuncio in storage.
     *
     * @param CreateAnuncioRequest $request
     *
     * @return Response
     */
    public function store(CreateAnuncioRequest $request)
    {
        $input = $request->all();

        $anuncio = $this->anuncioRepository->create($input);

        Flash::success('Anuncio saved successfully.');

        return redirect(route('anuncios.index'));
    }

    /**
     * Display the specified Anuncio.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $anuncio = $this->anuncioRepository->find($id);

        if (empty($anuncio)) {
            Flash::error('Anuncio not found');

            return redirect(route('anuncios.index'));
        }

        return view('anuncios.show')->with('anuncio', $anuncio);
    }

    /**
     * Show the form for editing the specified Anuncio.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $anuncio = $this->anuncioRepository->find($id);
        $users = User::pluck('name','id');

        if (empty($anuncio)) {
            Flash::error('Anuncio not found');

            return redirect(route('anuncios.index'));
        }

        return view('anuncios.edit')->with(compact('anuncio','users'));
    }

    /**
     * Update the specified Anuncio in storage.
     *
     * @param int $id
     * @param UpdateAnuncioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAnuncioRequest $request)
    {
        $anuncio = $this->anuncioRepository->find($id);

        if (empty($anuncio)) {
            Flash::error('Anuncio not found');

            return redirect(route('anuncios.index'));
        }

        $anuncio = $this->anuncioRepository->update($request->all(), $id);

        Flash::success('Anuncio updated successfully.');

        return redirect(route('anuncios.index'));
    }

    /**
     * Remove the specified Anuncio from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $anuncio = $this->anuncioRepository->find($id);

        if (empty($anuncio)) {
            Flash::error('Anuncio no encontrado');

            return redirect(route('anuncios.index'));
        }

        $this->anuncioRepository->delete($id);

        Flash::success('Anuncio eliminado.');

        return redirect(route('anuncios.index'));
    }


/*Disply with ajax */


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
