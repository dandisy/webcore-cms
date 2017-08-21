<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\RegulationDataTable;
use App\Http\Requests;
use App\Http\Requests\Admin\CreateRegulationRequest;
use App\Http\Requests\Admin\UpdateRegulationRequest;
use App\Repositories\Admin\RegulationRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class RegulationController extends AppBaseController
{
    /** @var  RegulationRepository */
    private $regulationRepository;

    public function __construct(RegulationRepository $regulationRepo)
    {
        $this->regulationRepository = $regulationRepo;
    }

    /**
     * Display a listing of the Regulation.
     *
     * @param RegulationDataTable $regulationDataTable
     * @return Response
     */
    public function index(RegulationDataTable $regulationDataTable)
    {
        return $regulationDataTable->render('admin.regulations.index');
    }

    /**
     * Show the form for creating a new Regulation.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.regulations.create');
    }

    /**
     * Store a newly created Regulation in storage.
     *
     * @param CreateRegulationRequest $request
     *
     * @return Response
     */
    public function store(CreateRegulationRequest $request)
    {
        $input = $request->all();

        $input['created_by'] = Auth::user()->id;

        $regulation = $this->regulationRepository->create($input);

        Flash::success('Regulation saved successfully.');

        return redirect(route('regulations.index'));
    }

    /**
     * Display the specified Regulation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $regulation = $this->regulationRepository->findWithoutFail($id);

        if (empty($regulation)) {
            Flash::error('Regulation not found');

            return redirect(route('regulations.index'));
        }

        return view('admin.regulations.show')->with('regulation', $regulation);
    }

    /**
     * Show the form for editing the specified Regulation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $regulation = $this->regulationRepository->findWithoutFail($id);

        if (empty($regulation)) {
            Flash::error('Regulation not found');

            return redirect(route('regulations.index'));
        }

        return view('admin.regulations.edit')->with('regulation', $regulation);
    }

    /**
     * Update the specified Regulation in storage.
     *
     * @param  int              $id
     * @param UpdateRegulationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRegulationRequest $request)
    {
        $regulation = $this->regulationRepository->findWithoutFail($id);

        if (empty($regulation)) {
            Flash::error('Regulation not found');

            return redirect(route('regulations.index'));
        }

        $regulation = $this->regulationRepository->update($request->all(), $id);

        Flash::success('Regulation updated successfully.');

        return redirect(route('regulations.index'));
    }

    /**
     * Remove the specified Regulation from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $regulation = $this->regulationRepository->findWithoutFail($id);

        if (empty($regulation)) {
            Flash::error('Regulation not found');

            return redirect(route('regulations.index'));
        }

        $this->regulationRepository->delete($id);

        Flash::success('Regulation deleted successfully.');

        return redirect(route('regulations.index'));
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
                $regulation = $this->regulationRepository->create($item->toArray());
            });
        });

        Flash::success('Regulation saved successfully.');

        return redirect(route('regulations.index'));
    }
}
