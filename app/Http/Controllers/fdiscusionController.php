<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatefdiscusionRequest;
use App\Http\Requests\UpdatefdiscusionRequest;
use App\Repositories\fdiscusionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class fdiscusionController extends AppBaseController
{
    /** @var  fdiscusionRepository */
    private $fdiscusionRepository;

    public function __construct(fdiscusionRepository $fdiscusionRepo)
    {
        $this->fdiscusionRepository = $fdiscusionRepo;
    }

    /**
     * Display a listing of the fdiscusion.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $fdiscusions = $this->fdiscusionRepository->all();

        return view('fdiscusions.index')
            ->with('fdiscusions', $fdiscusions);
    }

    /**
     * Show the form for creating a new fdiscusion.
     *
     * @return Response
     */
    public function create()
    {
        return view('fdiscusions.create');
    }

    /**
     * Store a newly created fdiscusion in storage.
     *
     * @param CreatefdiscusionRequest $request
     *
     * @return Response
     */
    public function store(CreatefdiscusionRequest $request)
    {
        $input = $request->all();

        $fdiscusion = $this->fdiscusionRepository->create($input);

        Flash::success('Fdiscusion saved successfully.');

        return redirect(route('fdiscusions.index'));
    }

    /**
     * Display the specified fdiscusion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $fdiscusion = $this->fdiscusionRepository->find($id);

        if (empty($fdiscusion)) {
            Flash::error('Fdiscusion not found');

            return redirect(route('fdiscusions.index'));
        }

        return view('fdiscusions.show')->with('fdiscusion', $fdiscusion);
    }

    /**
     * Show the form for editing the specified fdiscusion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $fdiscusion = $this->fdiscusionRepository->find($id);

        if (empty($fdiscusion)) {
            Flash::error('Fdiscusion not found');

            return redirect(route('fdiscusions.index'));
        }

        return view('fdiscusions.edit')->with('fdiscusion', $fdiscusion);
    }

    /**
     * Update the specified fdiscusion in storage.
     *
     * @param int $id
     * @param UpdatefdiscusionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatefdiscusionRequest $request)
    {
        $fdiscusion = $this->fdiscusionRepository->find($id);

        if (empty($fdiscusion)) {
            Flash::error('Fdiscusion not found');

            return redirect(route('fdiscusions.index'));
        }

        $fdiscusion = $this->fdiscusionRepository->update($request->all(), $id);

        Flash::success('Fdiscusion updated successfully.');

        return redirect(route('fdiscusions.index'));
    }

    /**
     * Remove the specified fdiscusion from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $fdiscusion = $this->fdiscusionRepository->find($id);

        if (empty($fdiscusion)) {
            Flash::error('Fdiscusion not found');

            return redirect(route('fdiscusions.index'));
        }

        $this->fdiscusionRepository->delete($id);

        Flash::success('Fdiscusion deleted successfully.');

        return redirect(route('fdiscusions.index'));
    }
}
