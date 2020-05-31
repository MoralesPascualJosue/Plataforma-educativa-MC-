<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContenidoRequest;
use App\Http\Requests\UpdateContenidoRequest;
use App\Repositories\ContenidoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ContenidoController extends AppBaseController
{
    /** @var  ContenidoRepository */
    private $contenidoRepository;

    public function __construct(ContenidoRepository $contenidoRepo)
    {
        $this->contenidoRepository = $contenidoRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Contenido.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $contenidos = $this->contenidoRepository->all();

        return view('contenidos.index')
            ->with('contenidos', $contenidos);
    }

    /**
     * Show the form for creating a new Contenido.
     *
     * @return Response
     */
    public function create()
    {
        return view('contenidos.create');
    }

    /**
     * Store a newly created Contenido in storage.
     *
     * @param CreateContenidoRequest $request
     *
     * @return Response
     */
    public function store(CreateContenidoRequest $request)
    {
        $input = $request->all();

        $contenido = $this->contenidoRepository->create($input);

        Flash::success('Contenido saved successfully.');

        return redirect(route('contenidos.index'));
    }

    /**
     * Display the specified Contenido.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contenido = $this->contenidoRepository->find($id);

        if (empty($contenido)) {
            Flash::error('Contenido not found');

            return redirect(route('contenidos.index'));
        }

        return view('contenidos.show')->with('contenido', $contenido);
    }

    /**
     * Show the form for editing the specified Contenido.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contenido = $this->contenidoRepository->find($id);

        if (empty($contenido)) {
            Flash::error('Contenido not found');

            return redirect(route('contenidos.index'));
        }

        return view('contenidos.edit')->with('contenido', $contenido);
    }

    /**
     * Update the specified Contenido in storage.
     *
     * @param int $id
     * @param UpdateContenidoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContenidoRequest $request)
    {
        $contenido = $this->contenidoRepository->find($id);

        if (empty($contenido)) {
            Flash::error('Contenido not found');

            return redirect(route('contenidos.index'));
        }

        $contenido = $this->contenidoRepository->update($request->all(), $id);

        Flash::success('Contenido updated successfully.');

        return redirect(route('contenidos.index'));
    }

    /**
     * Remove the specified Contenido from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contenido = $this->contenidoRepository->find($id);

        if (empty($contenido)) {
            Flash::error('Contenido not found');

            return redirect(route('contenidos.index'));
        }

        $this->contenidoRepository->delete($id);

        Flash::success('Contenido deleted successfully.');

        return redirect(route('contenidos.index'));
    }
}
