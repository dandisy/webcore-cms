<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ExceptionDataTable;
use App\Http\Requests;
use App\Http\Requests\Admin\CreateExceptionRequest;
use App\Http\Requests\Admin\UpdateExceptionRequest;
use App\Repositories\Admin\ExceptionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class ExceptionController extends AppBaseController
{
    /** @var  ExceptionRepository */
    private $exceptionRepository;

    public function __construct(ExceptionRepository $exceptionRepo)
    {
        $this->exceptionRepository = $exceptionRepo;
    }

    /**
     * Display a listing of the Exception.
     *
     * @param ExceptionDataTable $exceptionDataTable
     * @return Response
     */
    public function index(ExceptionDataTable $exceptionDataTable)
    {
        return $exceptionDataTable->render('admin.exceptions.index');
    }

    /**
     * Show the form for creating a new Exception.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.exceptions.create');
    }

    /**
     * Store a newly created Exception in storage.
     *
     * @param CreateExceptionRequest $request
     *
     * @return Response
     */
    public function store(CreateExceptionRequest $request)
    {
        $input = $request->all();

        $exception = $this->exceptionRepository->create($input);

        Flash::success('Exception saved successfully.');

        return redirect(route('exceptions.index'));
    }

    /**
     * Display the specified Exception.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $exception = $this->exceptionRepository->findWithoutFail($id);

        if (empty($exception)) {
            Flash::error('Exception not found');

            return redirect(route('exceptions.index'));
        }

        return view('admin.exceptions.show')->with('exception', $exception);
    }

    /**
     * Show the form for editing the specified Exception.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $exception = $this->exceptionRepository->findWithoutFail($id);

        if (empty($exception)) {
            Flash::error('Exception not found');

            return redirect(route('exceptions.index'));
        }

        return view('admin.exceptions.edit')->with('exception', $exception);
    }

    /**
     * Update the specified Exception in storage.
     *
     * @param  int              $id
     * @param UpdateExceptionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExceptionRequest $request)
    {
        $exception = $this->exceptionRepository->findWithoutFail($id);

        if (empty($exception)) {
            Flash::error('Exception not found');

            return redirect(route('exceptions.index'));
        }

        $request['verified_by'] = Auth::user()->id;

        $exception = $this->exceptionRepository->update($request->all(), $id);

        Flash::success('Exception updated successfully.');

        return redirect(route('exceptions.index'));
    }

    /**
     * Remove the specified Exception from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $exception = $this->exceptionRepository->findWithoutFail($id);

        if (empty($exception)) {
            Flash::error('Exception not found');

            return redirect(route('exceptions.index'));
        }

        $this->exceptionRepository->delete($id);

        Flash::success('Exception deleted successfully.');

        return redirect(route('exceptions.index'));
    }
}
