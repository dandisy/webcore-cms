<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Requests\API\Admin\CreateOriginAPIRequest;
use App\Http\Requests\API\Admin\UpdateOriginAPIRequest;
use App\Models\Admin\Origin;
use App\Repositories\Admin\OriginRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class OriginController
 * @package App\Http\Controllers\API\Admin
 */

class OriginAPIController extends AppBaseController
{
    /** @var  OriginRepository */
    private $originRepository;

    public function __construct(OriginRepository $originRepo)
    {
        $this->originRepository = $originRepo;
    }

    /**
     * Display a listing of the Origin.
     * GET|HEAD /origins
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->originRepository->pushCriteria(new RequestCriteria($request));
        $this->originRepository->pushCriteria(new LimitOffsetCriteria($request));
        $origins = $this->originRepository->all();

        return $this->sendResponse($origins->toArray(), 'Origins retrieved successfully');
    }

    /**
     * Store a newly created Origin in storage.
     * POST /origins
     *
     * @param CreateOriginAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateOriginAPIRequest $request)
    {
        $input = $request->all();

        $origins = $this->originRepository->create($input);

        return $this->sendResponse($origins->toArray(), 'Origin saved successfully');
    }

    /**
     * Display the specified Origin.
     * GET|HEAD /origins/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Origin $origin */
        $origin = $this->originRepository->findWithoutFail($id);

        if (empty($origin)) {
            return $this->sendError('Origin not found');
        }

        return $this->sendResponse($origin->toArray(), 'Origin retrieved successfully');
    }

    /**
     * Update the specified Origin in storage.
     * PUT/PATCH /origins/{id}
     *
     * @param  int $id
     * @param UpdateOriginAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOriginAPIRequest $request)
    {
        $input = $request->all();

        /** @var Origin $origin */
        $origin = $this->originRepository->findWithoutFail($id);

        if (empty($origin)) {
            return $this->sendError('Origin not found');
        }

        $origin = $this->originRepository->update($input, $id);

        return $this->sendResponse($origin->toArray(), 'Origin updated successfully');
    }

    /**
     * Remove the specified Origin from storage.
     * DELETE /origins/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Origin $origin */
        $origin = $this->originRepository->findWithoutFail($id);

        if (empty($origin)) {
            return $this->sendError('Origin not found');
        }

        $origin->delete();

        return $this->sendResponse($id, 'Origin deleted successfully');
    }
}
