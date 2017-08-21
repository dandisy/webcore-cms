<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateExceptionAPIRequest;
use App\Http\Requests\API\UpdateExceptionAPIRequest;
use App\Models\Exception;
use App\Repositories\ExceptionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ExceptionController
 * @package App\Http\Controllers\API
 */

class ExceptionAPIController extends AppBaseController
{
    /** @var  ExceptionRepository */
    private $exceptionRepository;

    public function __construct(ExceptionRepository $exceptionRepo)
    {
        $this->exceptionRepository = $exceptionRepo;
    }

    /**
     * Display a listing of the Exception.
     * GET|HEAD /exceptions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->exceptionRepository->pushCriteria(new RequestCriteria($request));
        $this->exceptionRepository->pushCriteria(new LimitOffsetCriteria($request));
        $exceptions = $this->exceptionRepository->all();

        return $this->sendResponse($exceptions->toArray(), 'Exceptions retrieved successfully');
    }

    /**
     * Store a newly created Exception in storage.
     * POST /exceptions
     *
     * @param CreateExceptionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateExceptionAPIRequest $request)
    {
        $input = $request->all();

        $exceptions = $this->exceptionRepository->create($input);

        return $this->sendResponse($exceptions->toArray(), 'Exception saved successfully');
    }

    /**
     * Display the specified Exception.
     * GET|HEAD /exceptions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Exception $exception */
        $exception = $this->exceptionRepository->findWithoutFail($id);

        if (empty($exception)) {
            return $this->sendError('Exception not found');
        }

        return $this->sendResponse($exception->toArray(), 'Exception retrieved successfully');
    }

    /**
     * Update the specified Exception in storage.
     * PUT/PATCH /exceptions/{id}
     *
     * @param  int $id
     * @param UpdateExceptionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExceptionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Exception $exception */
        $exception = $this->exceptionRepository->findWithoutFail($id);

        if (empty($exception)) {
            return $this->sendError('Exception not found');
        }

        $exception = $this->exceptionRepository->update($input, $id);

        return $this->sendResponse($exception->toArray(), 'Exception updated successfully');
    }

    /**
     * Remove the specified Exception from storage.
     * DELETE /exceptions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Exception $exception */
        $exception = $this->exceptionRepository->findWithoutFail($id);

        if (empty($exception)) {
            return $this->sendError('Exception not found');
        }

        $exception->delete();

        return $this->sendResponse($id, 'Exception deleted successfully');
    }
}
