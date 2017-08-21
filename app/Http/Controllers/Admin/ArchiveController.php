<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ArchiveDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateArchiveRequest;
use App\Http\Requests\Admin\UpdateArchiveRequest;
use App\Models\Admin\Format;
use App\Models\Admin\Origin;
use App\Models\Admin\Type;
use App\Repositories\Admin\ArchiveRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class ArchiveController extends AppBaseController
{
    /** @var  ArchiveRepository */
    private $archiveRepository;

    public function __construct(ArchiveRepository $archiveRepo)
    {
        $this->archiveRepository = $archiveRepo;
    }

    /**
     * Display a listing of the Archive.
     *
     * @param ArchiveDataTable $archiveDataTable
     * @return Response
     */
    public function index(ArchiveDataTable $archiveDataTable)
    {
        return $archiveDataTable->render('admin.archives.index');
    }

    /**
     * Show the form for creating a new Archive.
     *
     * @return Response
     */
    public function create()
    {
        $origin = Origin::all();
        $type = Type::all();
        $format = Format::all();

        return view('admin.archives.create')
            ->with('origin', $origin)
            ->with('type', $type)
            ->with('format', $format);
    }

    /**
     * Store a newly created Archive in storage.
     *
     * @param CreateArchiveRequest $request
     *
     * @return Response
     */
    public function store(CreateArchiveRequest $request)
    {
        $input = $request->all();

        $archive = $this->archiveRepository->create($input);

        Flash::success('Archive saved successfully.');

        return redirect(route('archives.index'));
    }

    /**
     * Display the specified Archive.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $archive = $this->archiveRepository->findWithoutFail($id);

        if (empty($archive)) {
            Flash::error('Archive not found');

            return redirect(route('archives.index'));
        }

        return view('admin.archives.show')->with('archive', $archive);
    }

    /**
     * Show the form for editing the specified Archive.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $archive = $this->archiveRepository->findWithoutFail($id);

        $origin = Origin::all();
        $type = Type::all();
        $format = Format::all();

        if (empty($archive)) {
            Flash::error('Archive not found');

            return redirect(route('archives.index'));
        }

        return view('admin.archives.edit')
            ->with('archive', $archive)
            ->with('origin', $origin)
            ->with('type', $type)
            ->with('format', $format);
    }

    /**
     * Update the specified Archive in storage.
     *
     * @param  int              $id
     * @param UpdateArchiveRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateArchiveRequest $request)
    {
        $archive = $this->archiveRepository->findWithoutFail($id);

        if (empty($archive)) {
            Flash::error('Archive not found');

            return redirect(route('archives.index'));
        }

        $archive = $this->archiveRepository->update($request->all(), $id);

        Flash::success('Archive updated successfully.');

        return redirect(route('archives.index'));
    }

    /**
     * Remove the specified Archive from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $archive = $this->archiveRepository->findWithoutFail($id);

        if (empty($archive)) {
            Flash::error('Archive not found');

            return redirect(route('archives.index'));
        }

        $this->archiveRepository->delete($id);

        Flash::success('Archive deleted successfully.');

        return redirect(route('archives.index'));
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
                $archive = $this->archiveRepository->create($item->toArray());
            });
        });

        Flash::success('Archive saved successfully.');

        return redirect(route('admin.archives.index'));
    }
}
