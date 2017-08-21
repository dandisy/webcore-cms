<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInformationAPIRequest;
use App\Http\Requests\API\UpdateInformationAPIRequest;
use App\Models\Information;
use App\Repositories\InformationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class InformationController
 * @package App\Http\Controllers\API
 */

class InformationAPIController extends AppBaseController
{
    /** @var  InformationRepository */
    private $informationRepository;

    public function __construct(InformationRepository $informationRepo)
    {
        $this->informationRepository = $informationRepo;
    }

    /**
     * Display a listing of the Information.
     * GET|HEAD /information
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->informationRepository->pushCriteria(new RequestCriteria($request));
        $this->informationRepository->pushCriteria(new LimitOffsetCriteria($request));
        $information = $this->informationRepository->all();

        return $this->sendResponse($information->toArray(), 'Information retrieved successfully');
    }

    /**
     * Store a newly created Information in storage.
     * POST /information
     *
     * @param CreateInformationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateInformationAPIRequest $request)
    {
        $input = $request->all();

        $information = $this->informationRepository->create($input);

        return $this->sendResponse($information->toArray(), 'Information saved successfully');
    }

    /**
     * Display the specified Information.
     * GET|HEAD /information/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Information $information */
        $information = $this->informationRepository->findWithoutFail($id);

        if (empty($information)) {
            return $this->sendError('Information not found');
        }

        return $this->sendResponse($information->toArray(), 'Information retrieved successfully');
    }

    /**
     * Update the specified Information in storage.
     * PUT/PATCH /information/{id}
     *
     * @param  int $id
     * @param UpdateInformationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInformationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Information $information */
        $information = $this->informationRepository->findWithoutFail($id);

        if (empty($information)) {
            return $this->sendError('Information not found');
        }

        $information = $this->informationRepository->update($input, $id);

        return $this->sendResponse($information->toArray(), 'Information updated successfully');
    }

    /**
     * Remove the specified Information from storage.
     * DELETE /information/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Information $information */
        $information = $this->informationRepository->findWithoutFail($id);

        if (empty($information)) {
            return $this->sendError('Information not found');
        }

        $information->delete();

        return $this->sendResponse($id, 'Information deleted successfully');
    }
}
