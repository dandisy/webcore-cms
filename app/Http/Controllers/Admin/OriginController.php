<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\OriginDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateOriginRequest;
use App\Http\Requests\Admin\UpdateOriginRequest;
use App\Repositories\Admin\OriginRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class OriginController extends AppBaseController
{
    /** @var  OriginRepository */
    private $originRepository;

    public function __construct(OriginRepository $originRepo)
    {
        $this->originRepository = $originRepo;
    }

    /**
     * Display a listing of the Origin.
     *
     * @param OriginDataTable $originDataTable
     * @return Response
     */
    public function index(OriginDataTable $originDataTable)
    {
        return $originDataTable->render('admin.origins.index');
    }

    /**
     * Show the form for creating a new Origin.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.origins.create');
    }

    /**
     * Store a newly created Origin in storage.
     *
     * @param CreateOriginRequest $request
     *
     * @return Response
     */
    public function store(CreateOriginRequest $request)
    {
        $input = $request->all();

        $origin = $this->originRepository->create($input);

        Flash::success('Origin saved successfully.');

        return redirect(route('origins.index'));
    }

    /**
     * Display the specified Origin.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $origin = $this->originRepository->findWithoutFail($id);

        if (empty($origin)) {
            Flash::error('Origin not found');

            return redirect(route('origins.index'));
        }

        return view('admin.origins.show')->with('origin', $origin);
    }

    /**
     * Show the form for editing the specified Origin.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $origin = $this->originRepository->findWithoutFail($id);

        if (empty($origin)) {
            Flash::error('Origin not found');

            return redirect(route('origins.index'));
        }

        return view('admin.origins.edit')->with('origin', $origin);
    }

    /**
     * Update the specified Origin in storage.
     *
     * @param  int              $id
     * @param UpdateOriginRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOriginRequest $request)
    {
        $origin = $this->originRepository->findWithoutFail($id);

        if (empty($origin)) {
            Flash::error('Origin not found');

            return redirect(route('origins.index'));
        }

        $origin = $this->originRepository->update($request->all(), $id);

        Flash::success('Origin updated successfully.');

        return redirect(route('origins.index'));
    }

    /**
     * Remove the specified Origin from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $origin = $this->originRepository->findWithoutFail($id);

        if (empty($origin)) {
            Flash::error('Origin not found');

            return redirect(route('origins.index'));
        }

        $this->originRepository->delete($id);

        Flash::success('Origin deleted successfully.');

        return redirect(route('origins.index'));
    }
}
