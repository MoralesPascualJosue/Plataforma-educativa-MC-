<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateActivitieRequest;
use App\Http\Requests\UpdateActivitieRequest;
use App\Repositories\ActivitieRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use Illuminate\Support\Facades\Auth;

class ActivitieController extends AppBaseController
{
    /** @var  ActivitieRepository */
    private $activitieRepository;

    public function __construct(ActivitieRepository $activitieRepo)
    {
        $this->activitieRepository = $activitieRepo;
    }

    /**
     * Display a listing of the Activitie.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $activities = $this->activitieRepository->all();

        return view('activities.index')
            ->with('activities', $activities);
    }

    /**
     * Show the form for creating a new Activitie.
     *
     * @return Response
     */
    public function create()
    {
        return view('activities.create');
    }

    /**
     * Store a newly created Activitie in storage.
     *
     * @param CreateActivitieRequest $request
     *
     * @return Response
     */
    public function store(CreateActivitieRequest $request)
    {
        $input = $request->all();

        $input['asesor_id'] = Auth::user()->asesor()->get()['0']->id;

        $activitie = $this->activitieRepository->create($input);

        Flash::success('Activitie saved successfully.');

        return redirect(route('activities.index'));
    }

    /**
     * Display the specified Activitie.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $activitie = $this->activitieRepository->find($id);
        if (empty($activitie)) {
            Flash::error('Activitie not found');

            return redirect(route('activities.index'));
        }

        return view('activities.show')->with(compact('activitie'));
    }

    /**
     * Show the form for editing the specified Activitie.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $activitie = $this->activitieRepository->find($id);

        if (empty($activitie)) {
            Flash::error('Activitie not found');

            return redirect(route('activities.index'));
        }

        return view('activities.edit')->with('activitie', $activitie);
    }

    /**
     * Update the specified Activitie in storage.
     *
     * @param int $id
     * @param UpdateActivitieRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivitieRequest $request)
    {
        $activitie = $this->activitieRepository->find($id);

        if (empty($activitie)) {
            Flash::error('Activitie not found');

            return redirect(route('activities.index'));
        }

        $activitie = $this->activitieRepository->update($request->all(), $id);

        Flash::success('Activitie updated successfully.');

        return redirect(route('activities.index'));
    }

    /**
     * Remove the specified Activitie from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $activitie = $this->activitieRepository->find($id);

        if (empty($activitie)) {
            Flash::error('Activitie not found');

            return redirect(route('activities.index'));
        }

        $this->activitieRepository->delete($id);

        Flash::success('Activitie deleted successfully.');

        return redirect(route('activities.index'));
    }
}
