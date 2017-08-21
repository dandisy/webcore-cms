<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ResponseDataTable;
use App\Http\Requests;
use App\Http\Requests\Admin\CreateResponseRequest;
use App\Http\Requests\Admin\UpdateResponseRequest;
use App\Repositories\Admin\ResponseRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class ResponseController extends AppBaseController
{
    /** @var  ResponseRepository */
    private $responseRepository;

    public function __construct(ResponseRepository $responseRepo)
    {
        $this->responseRepository = $responseRepo;
    }

    /**
     * Display a listing of the Response.
     *
     * @param ResponseDataTable $responseDataTable
     * @return Response
     */
    public function index(ResponseDataTable $responseDataTable)
    {
        return $responseDataTable->render('admin.responses.index');
    }

    /**
     * Show the form for creating a new Response.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.responses.create');
    }

    /**
     * Store a newly created Response in storage.
     *
     * @param CreateResponseRequest $request
     *
     * @return Response
     */
    public function store(CreateResponseRequest $request)
    {
        $input = $request->all();

        $input['created_by'] = Auth::user()->id;

        $response = $this->responseRepository->create($input);

        Flash::success('Response saved successfully.');

        return redirect(route('responses.index'));
    }

    /**
     * Display the specified Response.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $response = $this->responseRepository->findWithoutFail($id);

        if (empty($response)) {
            Flash::error('Response not found');

            return redirect(route('responses.index'));
        }

        return view('admin.responses.show')->with('response', $response);
    }

    /**
     * Show the form for editing the specified Response.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $response = $this->responseRepository->findWithoutFail($id);

        if (empty($response)) {
            Flash::error('Response not found');

            return redirect(route('responses.index'));
        }

        return view('admin.responses.edit')->with('response', $response);
    }

    /**
     * Update the specified Response in storage.
     *
     * @param  int              $id
     * @param UpdateResponseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateResponseRequest $request)
    {
        $response = $this->responseRepository->findWithoutFail($id);

        if (empty($response)) {
            Flash::error('Response not found');

            return redirect(route('responses.index'));
        }

        $response = $this->responseRepository->update($request->all(), $id);

        Flash::success('Response updated successfully.');

        return redirect(route('responses.index'));
    }

    /**
     * Remove the specified Response from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $response = $this->responseRepository->findWithoutFail($id);

        if (empty($response)) {
            Flash::error('Response not found');

            return redirect(route('responses.index'));
        }

        $this->responseRepository->delete($id);

        Flash::success('Response deleted successfully.');

        return redirect(route('responses.index'));
    }

    /**
     * Import xls file to table.
     *
     * @param  int $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $response = $this->responseRepository->create($item->toArray());
            });
        });

        Flash::success('Response saved successfully.');

        return redirect(route('responses.index'));
    }
}
