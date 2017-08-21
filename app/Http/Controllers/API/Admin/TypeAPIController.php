<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Requests\API\Admin\CreateTypeAPIRequest;
use App\Http\Requests\API\Admin\UpdateTypeAPIRequest;
use App\Models\Admin\Type;
use App\Repositories\Admin\TypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TypeController
 * @package App\Http\Controllers\API\Admin
 */

class TypeAPIController extends AppBaseController
{
    /** @var  TypeRepository */
    private $typeRepository;

    public function __construct(TypeRepository $typeRepo)
    {
        $this->typeRepository = $typeRepo;
    }

    /**
     * Display a listing of the Type.
     * GET|HEAD /types
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->typeRepository->pushCriteria(new RequestCriteria($request));
        $this->typeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $types = $this->typeRepository->all();

        return $this->sendResponse($types->toArray(), 'Types retrieved successfully');
    }

    /**
     * Store a newly created Type in storage.
     * POST /types
     *
     * @param CreateTypeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTypeAPIRequest $request)
    {
        $input = $request->all();

        $types = $this->typeRepository->create($input);

        return $this->sendResponse($types->toArray(), 'Type saved successfully');
    }

    /**
     * Display the specified Type.
     * GET|HEAD /types/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Type $type */
        $type = $this->typeRepository->findWithoutFail($id);

        if (empty($type)) {
            return $this->sendError('Type not found');
        }

        return $this->sendResponse($type->toArray(), 'Type retrieved successfully');
    }

    /**
     * Update the specified Type in storage.
     * PUT/PATCH /types/{id}
     *
     * @param  int $id
     * @param UpdateTypeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var Type $type */
        $type = $this->typeRepository->findWithoutFail($id);

        if (empty($type)) {
            return $this->sendError('Type not found');
        }

        $type = $this->typeRepository->update($input, $id);

        return $this->sendResponse($type->toArray(), 'Type updated successfully');
    }

    /**
     * Remove the specified Type from storage.
     * DELETE /types/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Type $type */
        $type = $this->typeRepository->findWithoutFail($id);

        if (empty($type)) {
            return $this->sendError('Type not found');
        }

        $type->delete();

        return $this->sendResponse($id, 'Type deleted successfully');
    }
}
