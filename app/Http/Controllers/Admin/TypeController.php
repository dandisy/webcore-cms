<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\TypeDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateTypeRequest;
use App\Http\Requests\Admin\UpdateTypeRequest;
use App\Repositories\Admin\TypeRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class TypeController extends AppBaseController
{
    /** @var  TypeRepository */
    private $typeRepository;

    public function __construct(TypeRepository $typeRepo)
    {
        $this->typeRepository = $typeRepo;
    }

    /**
     * Display a listing of the Type.
     *
     * @param TypeDataTable $typeDataTable
     * @return Response
     */
    public function index(TypeDataTable $typeDataTable)
    {
        return $typeDataTable->render('admin.types.index');
    }

    /**
     * Show the form for creating a new Type.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created Type in storage.
     *
     * @param CreateTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateTypeRequest $request)
    {
        $input = $request->all();

        $type = $this->typeRepository->create($input);

        Flash::success('Type saved successfully.');

        return redirect(route('types.index'));
    }

    /**
     * Display the specified Type.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $type = $this->typeRepository->findWithoutFail($id);

        if (empty($type)) {
            Flash::error('Type not found');

            return redirect(route('types.index'));
        }

        return view('admin.types.show')->with('type', $type);
    }

    /**
     * Show the form for editing the specified Type.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $type = $this->typeRepository->findWithoutFail($id);

        if (empty($type)) {
            Flash::error('Type not found');

            return redirect(route('types.index'));
        }

        return view('admin.types.edit')->with('type', $type);
    }

    /**
     * Update the specified Type in storage.
     *
     * @param  int              $id
     * @param UpdateTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTypeRequest $request)
    {
        $type = $this->typeRepository->findWithoutFail($id);

        if (empty($type)) {
            Flash::error('Type not found');

            return redirect(route('types.index'));
        }

        $type = $this->typeRepository->update($request->all(), $id);

        Flash::success('Type updated successfully.');

        return redirect(route('types.index'));
    }

    /**
     * Remove the specified Type from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $type = $this->typeRepository->findWithoutFail($id);

        if (empty($type)) {
            Flash::error('Type not found');

            return redirect(route('types.index'));
        }

        $this->typeRepository->delete($id);

        Flash::success('Type deleted successfully.');

        return redirect(route('types.index'));
    }
}
