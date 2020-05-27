<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMatriculadoRequest;
use App\Http\Requests\UpdateMatriculadoRequest;
use App\Repositories\MatriculadoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class MatriculadoController extends AppBaseController
{
    /** @var  MatriculadoRepository */
    private $matriculadoRepository;

    public function __construct(MatriculadoRepository $matriculadoRepo)
    {
        $this->matriculadoRepository = $matriculadoRepo;
    }

    /**
     * Display a listing of the Matriculado.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $matriculados = $this->matriculadoRepository->all();

        return view('matriculados.index')
            ->with('matriculados', $matriculados);
    }

    /**
     * Show the form for creating a new Matriculado.
     *
     * @return Response
     */
    public function create()
    {
        return view('matriculados.create');
    }

    /**
     * Store a newly created Matriculado in storage.
     *
     * @param CreateMatriculadoRequest $request
     *
     * @return Response
     */
    public function store(CreateMatriculadoRequest $request)
    {
        $input = $request->all();

        $matriculado = $this->matriculadoRepository->create($input);

        Flash::success('Matriculado saved successfully.');

        return redirect(route('matriculados.index'));
    }

    /**
     * Display the specified Matriculado.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $matriculado = $this->matriculadoRepository->find($id);

        if (empty($matriculado)) {
            Flash::error('Matriculado not found');

            return redirect(route('matriculados.index'));
        }

        return view('matriculados.show')->with('matriculado', $matriculado);
    }

    /**
     * Show the form for editing the specified Matriculado.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $matriculado = $this->matriculadoRepository->find($id);

        if (empty($matriculado)) {
            Flash::error('Matriculado not found');

            return redirect(route('matriculados.index'));
        }

        return view('matriculados.edit')->with('matriculado', $matriculado);
    }

    /**
     * Update the specified Matriculado in storage.
     *
     * @param int $id
     * @param UpdateMatriculadoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMatriculadoRequest $request)
    {
        $matriculado = $this->matriculadoRepository->find($id);

        if (empty($matriculado)) {
            Flash::error('Matriculado not found');

            return redirect(route('matriculados.index'));
        }

        $matriculado = $this->matriculadoRepository->update($request->all(), $id);

        Flash::success('Matriculado updated successfully.');

        return redirect(route('matriculados.index'));
    }

    /**
     * Remove the specified Matriculado from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $matriculado = $this->matriculadoRepository->find($id);

        if (empty($matriculado)) {
            Flash::error('Matriculado not found');

            return redirect(route('matriculados.index'));
        }

        $this->matriculadoRepository->delete($id);

        Flash::success('Matriculado deleted successfully.');

        return redirect(route('matriculados.index'));
    }
}
