<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\InformationDataTable;
use App\Http\Requests;
use App\Http\Requests\Admin\CreateInformationRequest;
use App\Http\Requests\Admin\UpdateInformationRequest;
use App\Models\Admin\Category;
use App\Models\Admin\Format;
use App\Models\Admin\Origin;
use App\Repositories\Admin\InformationRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class InformationController extends AppBaseController
{
    /** @var  InformationRepository */
    private $informationRepository;

    public function __construct(InformationRepository $informationRepo)
    {
        $this->informationRepository = $informationRepo;
    }

    /**
     * Display a listing of the Information.
     *
     * @param InformationDataTable $informationDataTable
     * @return Response
     */
    public function index(InformationDataTable $informationDataTable)
    {
        return $informationDataTable->render('admin.information.index');
    }

    /**
     * Show the form for creating a new Information.
     *
     * @return Response
     */
    public function create()
    {
        $origin = Origin::all();
        $category = Category::all();
        $format = Format::all();

        return view('admin.information.create')
            ->with('origin', $origin)
            ->with('category', $category)
            ->with('format', $format);
    }

    /**
     * Store a newly created Information in storage.
     *
     * @param CreateInformationRequest $request
     *
     * @return Response
     */
    public function store(CreateInformationRequest $request)
    {
        $input = $request->all();

        $input['created_by'] = Auth::user()->id;

        $information = $this->informationRepository->create($input);

        Flash::success('Information saved successfully.');

        return redirect(route('information.index'));
    }

    /**
     * Display the specified Information.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $information = $this->informationRepository->findWithoutFail($id);

        if (empty($information)) {
            Flash::error('Information not found');

            return redirect(route('information.index'));
        }

        return view('admin.information.show')->with('information', $information);
    }

    /**
     * Show the form for editing the specified Information.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $information = $this->informationRepository->findWithoutFail($id);

        $origin = Origin::all();
        $category = Category::all();
        $format = Format::all();

        if (empty($information)) {
            Flash::error('Information not found');

            return redirect(route('information.index'));
        }

        return view('admin.information.edit')
            ->with('information', $information)
            ->with('origin', $origin)
            ->with('category', $category)
            ->with('format', $format);;
    }

    /**
     * Update the specified Information in storage.
     *
     * @param  int              $id
     * @param UpdateInformationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInformationRequest $request)
    {
        $information = $this->informationRepository->findWithoutFail($id);

        if (empty($information)) {
            Flash::error('Information not found');

            return redirect(route('information.index'));
        }

        $information = $this->informationRepository->update($request->all(), $id);

        Flash::success('Information updated successfully.');

        return redirect(route('information.index'));
    }

    /**
     * Remove the specified Information from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $information = $this->informationRepository->findWithoutFail($id);

        if (empty($information)) {
            Flash::error('Information not found');

            return redirect(route('information.index'));
        }

        $this->informationRepository->delete($id);

        Flash::success('Information deleted successfully.');

        return redirect(route('information.index'));
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
                $information = $this->informationRepository->create($item->toArray());
            });
        });

        Flash::success('Information saved successfully.');

        return redirect(route('information.index'));
    }
}
