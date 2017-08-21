<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Requests\API\Admin\CreateArchiveAPIRequest;
use App\Http\Requests\API\Admin\UpdateArchiveAPIRequest;
use App\Models\Admin\Archive;
use App\Repositories\Admin\ArchiveRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ArchiveController
 * @package App\Http\Controllers\API\Admin
 */

class ArchiveAPIController extends AppBaseController
{
    /** @var  ArchiveRepository */
    private $archiveRepository;

    public function __construct(ArchiveRepository $archiveRepo)
    {
        $this->archiveRepository = $archiveRepo;
    }

    /**
     * Display a listing of the Archive.
     * GET|HEAD /archives
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->archiveRepository->pushCriteria(new RequestCriteria($request));
        $this->archiveRepository->pushCriteria(new LimitOffsetCriteria($request));
        $archives = $this->archiveRepository->all();

        return $this->sendResponse($archives->toArray(), 'Archives retrieved successfully');
    }

    /**
     * Store a newly created Archive in storage.
     * POST /archives
     *
     * @param CreateArchiveAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateArchiveAPIRequest $request)
    {
        $input = $request->all();

        $archives = $this->archiveRepository->create($input);

        return $this->sendResponse($archives->toArray(), 'Archive saved successfully');
    }

    /**
     * Display the specified Archive.
     * GET|HEAD /archives/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Archive $archive */
        $archive = $this->archiveRepository->findWithoutFail($id);

        if (empty($archive)) {
            return $this->sendError('Archive not found');
        }

        return $this->sendResponse($archive->toArray(), 'Archive retrieved successfully');
    }

    /**
     * Update the specified Archive in storage.
     * PUT/PATCH /archives/{id}
     *
     * @param  int $id
     * @param UpdateArchiveAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateArchiveAPIRequest $request)
    {
        $input = $request->all();

        /** @var Archive $archive */
        $archive = $this->archiveRepository->findWithoutFail($id);

        if (empty($archive)) {
            return $this->sendError('Archive not found');
        }

        $archive = $this->archiveRepository->update($input, $id);

        return $this->sendResponse($archive->toArray(), 'Archive updated successfully');
    }

    /**
     * Remove the specified Archive from storage.
     * DELETE /archives/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Archive $archive */
        $archive = $this->archiveRepository->findWithoutFail($id);

        if (empty($archive)) {
            return $this->sendError('Archive not found');
        }

        $archive->delete();

        return $this->sendResponse($id, 'Archive deleted successfully');
    }
}
