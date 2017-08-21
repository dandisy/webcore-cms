<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\FormatDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateFormatRequest;
use App\Http\Requests\Admin\UpdateFormatRequest;
use App\Repositories\Admin\FormatRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class FormatController extends AppBaseController
{
    /** @var  FormatRepository */
    private $formatRepository;

    public function __construct(FormatRepository $formatRepo)
    {
        $this->formatRepository = $formatRepo;
    }

    /**
     * Display a listing of the Format.
     *
     * @param FormatDataTable $formatDataTable
     * @return Response
     */
    public function index(FormatDataTable $formatDataTable)
    {
        return $formatDataTable->render('admin.formats.index');
    }

    /**
     * Show the form for creating a new Format.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.formats.create');
    }

    /**
     * Store a newly created Format in storage.
     *
     * @param CreateFormatRequest $request
     *
     * @return Response
     */
    public function store(CreateFormatRequest $request)
    {
        $input = $request->all();

        $format = $this->formatRepository->create($input);

        Flash::success('Format saved successfully.');

        return redirect(route('formats.index'));
    }

    /**
     * Display the specified Format.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $format = $this->formatRepository->findWithoutFail($id);

        if (empty($format)) {
            Flash::error('Format not found');

            return redirect(route('formats.index'));
        }

        return view('admin.formats.show')->with('format', $format);
    }

    /**
     * Show the form for editing the specified Format.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $format = $this->formatRepository->findWithoutFail($id);

        if (empty($format)) {
            Flash::error('Format not found');

            return redirect(route('formats.index'));
        }

        return view('admin.formats.edit')->with('format', $format);
    }

    /**
     * Update the specified Format in storage.
     *
     * @param  int              $id
     * @param UpdateFormatRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFormatRequest $request)
    {
        $format = $this->formatRepository->findWithoutFail($id);

        if (empty($format)) {
            Flash::error('Format not found');

            return redirect(route('formats.index'));
        }

        $format = $this->formatRepository->update($request->all(), $id);

        Flash::success('Format updated successfully.');

        return redirect(route('formats.index'));
    }

    /**
     * Remove the specified Format from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $format = $this->formatRepository->findWithoutFail($id);

        if (empty($format)) {
            Flash::error('Format not found');

            return redirect(route('formats.index'));
        }

        $this->formatRepository->delete($id);

        Flash::success('Format deleted successfully.');

        return redirect(route('formats.index'));
    }
}
