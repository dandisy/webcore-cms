<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Requests\API\Admin\CreateFormatAPIRequest;
use App\Http\Requests\API\Admin\UpdateFormatAPIRequest;
use App\Models\Admin\Format;
use App\Repositories\Admin\FormatRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class FormatController
 * @package App\Http\Controllers\API\Admin
 */

class FormatAPIController extends AppBaseController
{
    /** @var  FormatRepository */
    private $formatRepository;

    public function __construct(FormatRepository $formatRepo)
    {
        $this->formatRepository = $formatRepo;
    }

    /**
     * Display a listing of the Format.
     * GET|HEAD /formats
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->formatRepository->pushCriteria(new RequestCriteria($request));
        $this->formatRepository->pushCriteria(new LimitOffsetCriteria($request));
        $formats = $this->formatRepository->all();

        return $this->sendResponse($formats->toArray(), 'Formats retrieved successfully');
    }

    /**
     * Store a newly created Format in storage.
     * POST /formats
     *
     * @param CreateFormatAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFormatAPIRequest $request)
    {
        $input = $request->all();

        $formats = $this->formatRepository->create($input);

        return $this->sendResponse($formats->toArray(), 'Format saved successfully');
    }

    /**
     * Display the specified Format.
     * GET|HEAD /formats/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Format $format */
        $format = $this->formatRepository->findWithoutFail($id);

        if (empty($format)) {
            return $this->sendError('Format not found');
        }

        return $this->sendResponse($format->toArray(), 'Format retrieved successfully');
    }

    /**
     * Update the specified Format in storage.
     * PUT/PATCH /formats/{id}
     *
     * @param  int $id
     * @param UpdateFormatAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFormatAPIRequest $request)
    {
        $input = $request->all();

        /** @var Format $format */
        $format = $this->formatRepository->findWithoutFail($id);

        if (empty($format)) {
            return $this->sendError('Format not found');
        }

        $format = $this->formatRepository->update($input, $id);

        return $this->sendResponse($format->toArray(), 'Format updated successfully');
    }

    /**
     * Remove the specified Format from storage.
     * DELETE /formats/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Format $format */
        $format = $this->formatRepository->findWithoutFail($id);

        if (empty($format)) {
            return $this->sendError('Format not found');
        }

        $format->delete();

        return $this->sendResponse($id, 'Format deleted successfully');
    }
}
