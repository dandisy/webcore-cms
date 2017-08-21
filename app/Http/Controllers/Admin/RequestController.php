<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\RequestDataTable;
use App\Http\Requests;
use App\Http\Requests\Admin\CreateRequestRequest;
use App\Http\Requests\Admin\UpdateRequestRequest;
use App\Repositories\Admin\RequestRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class RequestController extends AppBaseController
{
    /** @var  RequestRepository */
    private $requestRepository;

    public function __construct(RequestRepository $requestRepo)
    {
        $this->requestRepository = $requestRepo;
    }

    /**
     * Display a listing of the Request.
     *
     * @param RequestDataTable $requestDataTable
     * @return Response
     */
    public function index(RequestDataTable $requestDataTable)
    {
        return $requestDataTable->render('admin.requests.index');
    }

    /**
     * Show the form for creating a new Request.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.requests.create');
    }

    /**
     * Store a newly created Request in storage.
     *
     * @param CreateRequestRequest $request
     *
     * @return Response
     */
    public function store(CreateRequestRequest $request)
    {
        $input = $request->all();

        $requests = $this->requestRepository->create($input);

        Flash::success('Request saved successfully.');

        return redirect(route('requests.index'));
    }

    /**
     * Display the specified Request.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $requests = $this->requestRepository->findWithoutFail($id);

        if (empty($requests)) {
            Flash::error('Request not found');

            return redirect(route('requests.index'));
        }

        return view('admin.requests.show')->with('request', $requests);
    }

    /**
     * Show the form for editing the specified Request.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $requests = $this->requestRepository->findWithoutFail($id);

        if (empty($requests)) {
            Flash::error('Request not found');

            return redirect(route('requests.index'));
        }

        return view('admin.requests.edit')->with('request', $requests);
    }

    /**
     * Update the specified Request in storage.
     *
     * @param  int              $id
     * @param UpdateRequestRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRequestRequest $request)
    {
        $requests = $this->requestRepository->findWithoutFail($id);

        if (empty($requests)) {
            Flash::error('Request not found');

            return redirect(route('requests.index'));
        }

        $request['verified_by'] = Auth::user()->id;

        $requests = $this->requestRepository->update($request->all(), $id);

        Flash::success('Request updated successfully.');

        return redirect(route('requests.index'));
    }

    /**
     * Remove the specified Request from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $requests = $this->requestRepository->findWithoutFail($id);

        if (empty($requests)) {
            Flash::error('Request not found');

            return redirect(route('requests.index'));
        }

        $this->requestRepository->delete($id);

        Flash::success('Request deleted successfully.');

        return redirect(route('requests.index'));
    }
}
