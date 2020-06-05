<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createuser_fdiscusionRequest;
use App\Http\Requests\Updateuser_fdiscusionRequest;
use App\Repositories\user_fdiscusionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class user_fdiscusionController extends AppBaseController
{
    /** @var  user_fdiscusionRepository */
    private $userFdiscusionRepository;

    public function __construct(user_fdiscusionRepository $userFdiscusionRepo)
    {
        $this->userFdiscusionRepository = $userFdiscusionRepo;
    }

    /**
     * Display a listing of the user_fdiscusion.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $userFdiscusions = $this->userFdiscusionRepository->all();

        return view('user_fdiscusions.index')
            ->with('userFdiscusions', $userFdiscusions);
    }

    /**
     * Show the form for creating a new user_fdiscusion.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_fdiscusions.create');
    }

    /**
     * Store a newly created user_fdiscusion in storage.
     *
     * @param Createuser_fdiscusionRequest $request
     *
     * @return Response
     */
    public function store(Createuser_fdiscusionRequest $request)
    {
        $input = $request->all();

        $userFdiscusion = $this->userFdiscusionRepository->create($input);

        Flash::success('User Fdiscusion saved successfully.');

        return redirect(route('userFdiscusions.index'));
    }

    /**
     * Display the specified user_fdiscusion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userFdiscusion = $this->userFdiscusionRepository->find($id);

        if (empty($userFdiscusion)) {
            Flash::error('User Fdiscusion not found');

            return redirect(route('userFdiscusions.index'));
        }

        return view('user_fdiscusions.show')->with('userFdiscusion', $userFdiscusion);
    }

    /**
     * Show the form for editing the specified user_fdiscusion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userFdiscusion = $this->userFdiscusionRepository->find($id);

        if (empty($userFdiscusion)) {
            Flash::error('User Fdiscusion not found');

            return redirect(route('userFdiscusions.index'));
        }

        return view('user_fdiscusions.edit')->with('userFdiscusion', $userFdiscusion);
    }

    /**
     * Update the specified user_fdiscusion in storage.
     *
     * @param int $id
     * @param Updateuser_fdiscusionRequest $request
     *
     * @return Response
     */
    public function update($id, Updateuser_fdiscusionRequest $request)
    {
        $userFdiscusion = $this->userFdiscusionRepository->find($id);

        if (empty($userFdiscusion)) {
            Flash::error('User Fdiscusion not found');

            return redirect(route('userFdiscusions.index'));
        }

        $userFdiscusion = $this->userFdiscusionRepository->update($request->all(), $id);

        Flash::success('User Fdiscusion updated successfully.');

        return redirect(route('userFdiscusions.index'));
    }

    /**
     * Remove the specified user_fdiscusion from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userFdiscusion = $this->userFdiscusionRepository->find($id);

        if (empty($userFdiscusion)) {
            Flash::error('User Fdiscusion not found');

            return redirect(route('userFdiscusions.index'));
        }

        $this->userFdiscusionRepository->delete($id);

        Flash::success('User Fdiscusion deleted successfully.');

        return redirect(route('userFdiscusions.index'));
    }
}
