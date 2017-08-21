<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRequestAPIRequest;
use App\Http\Requests\API\UpdateRequestAPIRequest;
use App\Models\Request;
use App\Repositories\RequestRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class RequestController
 * @package App\Http\Controllers\API
 */

class RequestAPIController extends AppBaseController
{
    /** @var  RequestRepository */
    private $requestRepository;

    public function __construct(RequestRepository $requestRepo)
    {
        $this->requestRepository = $requestRepo;
    }

    /**
     * Display a listing of the Request.
     * GET|HEAD /requests
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->requestRepository->pushCriteria(new RequestCriteria($request));
        $this->requestRepository->pushCriteria(new LimitOffsetCriteria($request));
        $requests = $this->requestRepository->all();

        return $this->sendResponse($requests->toArray(), 'Requests retrieved successfully');
    }

    /**
     * Store a newly created Request in storage.
     * POST /requests
     *
     * @param CreateRequestAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRequestAPIRequest $request)
    {
        $input = $request->all();

        $requests = $this->requestRepository->create($input);

        return $this->sendResponse($requests->toArray(), 'Request saved successfully');
    }

    /**
     * Display the specified Request.
     * GET|HEAD /requests/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Request $request */
        $request = $this->requestRepository->findWithoutFail($id);

        if (empty($request)) {
            return $this->sendError('Request not found');
        }

        return $this->sendResponse($request->toArray(), 'Request retrieved successfully');
    }

    /**
     * Update the specified Request in storage.
     * PUT/PATCH /requests/{id}
     *
     * @param  int $id
     * @param UpdateRequestAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRequestAPIRequest $request)
    {
        $input = $request->all();

        /** @var Request $request */
        $request = $this->requestRepository->findWithoutFail($id);

        if (empty($request)) {
            return $this->sendError('Request not found');
        }

        $request = $this->requestRepository->update($input, $id);

        return $this->sendResponse($request->toArray(), 'Request updated successfully');
    }

    /**
     * Remove the specified Request from storage.
     * DELETE /requests/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Request $request */
        $request = $this->requestRepository->findWithoutFail($id);

        if (empty($request)) {
            return $this->sendError('Request not found');
        }

        $request->delete();

        return $this->sendResponse($id, 'Request deleted successfully');
    }
}
