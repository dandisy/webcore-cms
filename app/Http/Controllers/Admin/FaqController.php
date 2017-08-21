<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\FaqDataTable;
use App\Http\Requests;
use App\Http\Requests\Admin\CreateFaqRequest;
use App\Http\Requests\Admin\UpdateFaqRequest;
use App\Repositories\Admin\FaqRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class FaqController extends AppBaseController
{
    /** @var  FaqRepository */
    private $faqRepository;

    public function __construct(FaqRepository $faqRepo)
    {
        $this->faqRepository = $faqRepo;
    }

    /**
     * Display a listing of the Faq.
     *
     * @param FaqDataTable $faqDataTable
     * @return Response
     */
    public function index(FaqDataTable $faqDataTable)
    {
        return $faqDataTable->render('admin.faqs.index');
    }

    /**
     * Show the form for creating a new Faq.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.faqs.create');
    }

    /**
     * Store a newly created Faq in storage.
     *
     * @param CreateFaqRequest $request
     *
     * @return Response
     */
    public function store(CreateFaqRequest $request)
    {
        $input = $request->all();

        $faq = $this->faqRepository->create($input);

        Flash::success('Faq saved successfully.');

        return redirect(route('faqs.index'));
    }

    /**
     * Display the specified Faq.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $faq = $this->faqRepository->findWithoutFail($id);

        if (empty($faq)) {
            Flash::error('Faq not found');

            return redirect(route('faqs.index'));
        }

        return view('admin.faqs.show')->with('faq', $faq);
    }

    /**
     * Show the form for editing the specified Faq.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $faq = $this->faqRepository->findWithoutFail($id);

        if (empty($faq)) {
            Flash::error('Faq not found');

            return redirect(route('faqs.index'));
        }

        return view('admin.faqs.edit')->with('faq', $faq);
    }

    /**
     * Update the specified Faq in storage.
     *
     * @param  int              $id
     * @param UpdateFaqRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFaqRequest $request)
    {
        $faq = $this->faqRepository->findWithoutFail($id);

        if (empty($faq)) {
            Flash::error('Faq not found');

            return redirect(route('faqs.index'));
        }

        $faq = $this->faqRepository->update($request->all(), $id);

        Flash::success('Faq updated successfully.');

        return redirect(route('faqs.index'));
    }

    /**
     * Remove the specified Faq from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $faq = $this->faqRepository->findWithoutFail($id);

        if (empty($faq)) {
            Flash::error('Faq not found');

            return redirect(route('faqs.index'));
        }

        $this->faqRepository->delete($id);

        Flash::success('Faq deleted successfully.');

        return redirect(route('faqs.index'));
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
                $faq = $this->faqRepository->create($item->toArray());
            });
        });

        Flash::success('Faq saved successfully.');

        return redirect(route('faqs.index'));
    }
}
