<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAsesorRequest;
use App\Http\Requests\UpdateAsesorRequest;
use App\Repositories\AsesorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Asesor;

class AsesorController extends AppBaseController
{
    /** @var  AsesorRepository */
    private $asesorRepository;

    public function __construct(AsesorRepository $asesorRepo)
    {
        $this->asesorRepository = $asesorRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Asesor.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $asesors = $this->asesorRepository->all();
        $asesors = Asesor::orderBy('id','DESC')->paginate(3);

        return view('asesors.index')
            ->with('asesors', $asesors);
    }

    /**
     * Show the form for creating a new Asesor.
     *
     * @return Response
     */
    public function create()
    {
        return view('asesors.create');
    }

    /**
     * Store a newly created Asesor in storage.
     *
     * @param CreateAsesorRequest $request
     *
     * @return Response
     */
    public function store(CreateAsesorRequest $request)
    {
        $input = $request->all();
         $input['user_id'] = Auth::user()->id;

        $asesor = $this->asesorRepository->create($input);

        if($request->file('image')){
            $path = Storage::disk('public')->put('photos',$request->file('image'));
            $asesor->fill(['image'=>asset($path)])->save();
        }

        Flash::success('Asesor saved successfully.');

        return redirect(route('asesors.index'));
    }

    /**
     * Display the specified Asesor.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $asesor = $this->asesorRepository->find($id);

        if (empty($asesor)) {
            Flash::error('Asesor not found');

            return redirect(route('asesors.index'));
        }

        return view('asesors.show')->with('asesor', $asesor);
    }

    /**
     * Show the form for editing the specified Asesor.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $asesor = $this->asesorRepository->find($id);

        if (empty($asesor)) {
            Flash::error('Asesor not found');

            return redirect(route('asesors.index'));
        }

        return view('asesors.edit')->with('asesor',$asesor);
    }

    /**
     * Update the specified Asesor in storage.
     *
     * @param int $id
     * @param UpdateAsesorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAsesorRequest $request)
    {
        $asesor = $this->asesorRepository->find($id);

        if (empty($asesor)) {
            Flash::error('Asesor not found');

            return redirect(route('asesors.index'));
        }

        $asesor = $this->asesorRepository->update($request->all(), $id);  
        
        if($request->file('image')){
            $path = Storage::disk('public')->put('photos',$request->file('image'));
            $asesor->fill(['image'=>asset($path)])->save();
        }      

        Flash::success('Asesor updated successfully.');

        return redirect(route('asesors.index'));
    }

    /**
     * Remove the specified Asesor from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $asesor = $this->asesorRepository->find($id);

        if (empty($asesor)) {
            Flash::error('Asesor not found');

            return redirect(route('asesors.index'));
        }

        $this->asesorRepository->delete($id);

        Flash::success('Asesor deleted successfully.');

        return redirect(route('asesors.index'));
    }

/* ajax display */


}