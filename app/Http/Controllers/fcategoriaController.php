<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatefcategoriaRequest;
use App\Http\Requests\UpdatefcategoriaRequest;
use App\Repositories\fcategoriaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class fcategoriaController extends AppBaseController
{
    /** @var  fcategoriaRepository */
    private $fcategoriaRepository;

    public function __construct(fcategoriaRepository $fcategoriaRepo)
    {
        $this->fcategoriaRepository = $fcategoriaRepo;
    }

    /**
     * Display a listing of the fcategoria.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $fcategorias = $this->fcategoriaRepository->all();

        return view('fcategorias.index')
            ->with('fcategorias', $fcategorias);
    }

    /**
     * Show the form for creating a new fcategoria.
     *
     * @return Response
     */
    public function create()
    {
        return view('fcategorias.create');
    }

    /**
     * Store a newly created fcategoria in storage.
     *
     * @param CreatefcategoriaRequest $request
     *
     * @return Response
     */
    public function store(CreatefcategoriaRequest $request)
    {
        $input = $request->all();

        $fcategoria = $this->fcategoriaRepository->create($input);

        Flash::success('Fcategoria saved successfully.');

        return redirect(route('fcategorias.index'));
    }

    /**
     * Display the specified fcategoria.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $fcategoria = $this->fcategoriaRepository->find($id);

        if (empty($fcategoria)) {
            Flash::error('Fcategoria not found');

            return redirect(route('fcategorias.index'));
        }

        return view('fcategorias.show')->with('fcategoria', $fcategoria);
    }

    /**
     * Show the form for editing the specified fcategoria.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $fcategoria = $this->fcategoriaRepository->find($id);

        if (empty($fcategoria)) {
            Flash::error('Fcategoria not found');

            return redirect(route('fcategorias.index'));
        }

        return view('fcategorias.edit')->with('fcategoria', $fcategoria);
    }

    /**
     * Update the specified fcategoria in storage.
     *
     * @param int $id
     * @param UpdatefcategoriaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatefcategoriaRequest $request)
    {
        $fcategoria = $this->fcategoriaRepository->find($id);

        if (empty($fcategoria)) {
            Flash::error('Fcategoria not found');

            return redirect(route('fcategorias.index'));
        }

        $fcategoria = $this->fcategoriaRepository->update($request->all(), $id);

        Flash::success('Fcategoria updated successfully.');

        return redirect(route('fcategorias.index'));
    }

    /**
     * Remove the specified fcategoria from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $fcategoria = $this->fcategoriaRepository->find($id);

        if (empty($fcategoria)) {
            Flash::error('Fcategoria not found');

            return redirect(route('fcategorias.index'));
        }

        $this->fcategoriaRepository->delete($id);

        Flash::success('Fcategoria deleted successfully.');

        return redirect(route('fcategorias.index'));
    }
}
