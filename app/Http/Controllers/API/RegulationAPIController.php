<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRegulationAPIRequest;
use App\Http\Requests\API\UpdateRegulationAPIRequest;
use App\Models\Regulation;
use App\Repositories\RegulationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class RegulationController
 * @package App\Http\Controllers\API
 */

class RegulationAPIController extends AppBaseController
{
    /** @var  RegulationRepository */
    private $regulationRepository;

    public function __construct(RegulationRepository $regulationRepo)
    {
        $this->regulationRepository = $regulationRepo;
    }

    /**
     * Display a listing of the Regulation.
     * GET|HEAD /regulations
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->regulationRepository->pushCriteria(new RequestCriteria($request));
        $this->regulationRepository->pushCriteria(new LimitOffsetCriteria($request));
        $regulations = $this->regulationRepository->all();

        return $this->sendResponse($regulations->toArray(), 'Regulations retrieved successfully');
    }

    /**
     * Store a newly created Regulation in storage.
     * POST /regulations
     *
     * @param CreateRegulationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRegulationAPIRequest $request)
    {
        $input = $request->all();

        $regulations = $this->regulationRepository->create($input);

        return $this->sendResponse($regulations->toArray(), 'Regulation saved successfully');
    }

    /**
     * Display the specified Regulation.
     * GET|HEAD /regulations/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Regulation $regulation */
        $regulation = $this->regulationRepository->findWithoutFail($id);

        if (empty($regulation)) {
            return $this->sendError('Regulation not found');
        }

        return $this->sendResponse($regulation->toArray(), 'Regulation retrieved successfully');
    }

    /**
     * Update the specified Regulation in storage.
     * PUT/PATCH /regulations/{id}
     *
     * @param  int $id
     * @param UpdateRegulationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRegulationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Regulation $regulation */
        $regulation = $this->regulationRepository->findWithoutFail($id);

        if (empty($regulation)) {
            return $this->sendError('Regulation not found');
        }

        $regulation = $this->regulationRepository->update($input, $id);

        return $this->sendResponse($regulation->toArray(), 'Regulation updated successfully');
    }

    /**
     * Remove the specified Regulation from storage.
     * DELETE /regulations/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Regulation $regulation */
        $regulation = $this->regulationRepository->findWithoutFail($id);

        if (empty($regulation)) {
            return $this->sendError('Regulation not found');
        }

        $regulation->delete();

        return $this->sendResponse($id, 'Regulation deleted successfully');
    }
}
