<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateResponseAPIRequest;
use App\Http\Requests\API\UpdateResponseAPIRequest;
use App\Models\Response;
use App\Repositories\ResponseRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ResponseController
 * @package App\Http\Controllers\API
 */

class ResponseAPIController extends AppBaseController
{
    /** @var  ResponseRepository */
    private $responseRepository;

    public function __construct(ResponseRepository $responseRepo)
    {
        $this->responseRepository = $responseRepo;
    }

    /**
     * Display a listing of the Response.
     * GET|HEAD /responses
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->responseRepository->pushCriteria(new RequestCriteria($request));
        $this->responseRepository->pushCriteria(new LimitOffsetCriteria($request));
        $responses = $this->responseRepository->all();

        return $this->sendResponse($responses->toArray(), 'Responses retrieved successfully');
    }

    /**
     * Store a newly created Response in storage.
     * POST /responses
     *
     * @param CreateResponseAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateResponseAPIRequest $request)
    {
        $input = $request->all();

        $responses = $this->responseRepository->create($input);

        return $this->sendResponse($responses->toArray(), 'Response saved successfully');
    }

    /**
     * Display the specified Response.
     * GET|HEAD /responses/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Response $response */
        $response = $this->responseRepository->findWithoutFail($id);

        if (empty($response)) {
            return $this->sendError('Response not found');
        }

        return $this->sendResponse($response->toArray(), 'Response retrieved successfully');
    }

    /**
     * Update the specified Response in storage.
     * PUT/PATCH /responses/{id}
     *
     * @param  int $id
     * @param UpdateResponseAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateResponseAPIRequest $request)
    {
        $input = $request->all();

        /** @var Response $response */
        $response = $this->responseRepository->findWithoutFail($id);

        if (empty($response)) {
            return $this->sendError('Response not found');
        }

        $response = $this->responseRepository->update($input, $id);

        return $this->sendResponse($response->toArray(), 'Response updated successfully');
    }

    /**
     * Remove the specified Response from storage.
     * DELETE /responses/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Response $response */
        $response = $this->responseRepository->findWithoutFail($id);

        if (empty($response)) {
            return $this->sendError('Response not found');
        }

        $response->delete();

        return $this->sendResponse($id, 'Response deleted successfully');
    }
}
