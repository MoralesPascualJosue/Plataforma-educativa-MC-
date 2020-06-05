<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatefpostRequest;
use App\Http\Requests\UpdatefpostRequest;
use App\Repositories\fpostRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class fpostController extends AppBaseController
{
    /** @var  fpostRepository */
    private $fpostRepository;

    public function __construct(fpostRepository $fpostRepo)
    {
        $this->fpostRepository = $fpostRepo;
    }

    /**
     * Display a listing of the fpost.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $fposts = $this->fpostRepository->all();

        return view('fposts.index')
            ->with('fposts', $fposts);
    }

    /**
     * Show the form for creating a new fpost.
     *
     * @return Response
     */
    public function create()
    {
        return view('fposts.create');
    }

    /**
     * Store a newly created fpost in storage.
     *
     * @param CreatefpostRequest $request
     *
     * @return Response
     */
    public function store(CreatefpostRequest $request)
    {
        $input = $request->all();

        $fpost = $this->fpostRepository->create($input);

        Flash::success('Fpost saved successfully.');

        return redirect(route('fposts.index'));
    }

    /**
     * Display the specified fpost.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $fpost = $this->fpostRepository->find($id);

        if (empty($fpost)) {
            Flash::error('Fpost not found');

            return redirect(route('fposts.index'));
        }

        return view('fposts.show')->with('fpost', $fpost);
    }

    /**
     * Show the form for editing the specified fpost.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $fpost = $this->fpostRepository->find($id);

        if (empty($fpost)) {
            Flash::error('Fpost not found');

            return redirect(route('fposts.index'));
        }

        return view('fposts.edit')->with('fpost', $fpost);
    }

    /**
     * Update the specified fpost in storage.
     *
     * @param int $id
     * @param UpdatefpostRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatefpostRequest $request)
    {
        $fpost = $this->fpostRepository->find($id);

        if (empty($fpost)) {
            Flash::error('Fpost not found');

            return redirect(route('fposts.index'));
        }

        $fpost = $this->fpostRepository->update($request->all(), $id);

        Flash::success('Fpost updated successfully.');

        return redirect(route('fposts.index'));
    }

    /**
     * Remove the specified fpost from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $fpost = $this->fpostRepository->find($id);

        if (empty($fpost)) {
            Flash::error('Fpost not found');

            return redirect(route('fposts.index'));
        }

        $this->fpostRepository->delete($id);

        Flash::success('Fpost deleted successfully.');

        return redirect(route('fposts.index'));
    }
}
