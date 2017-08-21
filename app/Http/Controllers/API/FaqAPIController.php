<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFaqAPIRequest;
use App\Http\Requests\API\UpdateFaqAPIRequest;
use App\Models\Faq;
use App\Repositories\FaqRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class FaqController
 * @package App\Http\Controllers\API
 */

class FaqAPIController extends AppBaseController
{
    /** @var  FaqRepository */
    private $faqRepository;

    public function __construct(FaqRepository $faqRepo)
    {
        $this->faqRepository = $faqRepo;
    }

    /**
     * Display a listing of the Faq.
     * GET|HEAD /faqs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->faqRepository->pushCriteria(new RequestCriteria($request));
        $this->faqRepository->pushCriteria(new LimitOffsetCriteria($request));
        $faqs = $this->faqRepository->all();

        return $this->sendResponse($faqs->toArray(), 'Faqs retrieved successfully');
    }

    /**
     * Store a newly created Faq in storage.
     * POST /faqs
     *
     * @param CreateFaqAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFaqAPIRequest $request)
    {
        $input = $request->all();

        $faqs = $this->faqRepository->create($input);

        return $this->sendResponse($faqs->toArray(), 'Faq saved successfully');
    }

    /**
     * Display the specified Faq.
     * GET|HEAD /faqs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Faq $faq */
        $faq = $this->faqRepository->findWithoutFail($id);

        if (empty($faq)) {
            return $this->sendError('Faq not found');
        }

        return $this->sendResponse($faq->toArray(), 'Faq retrieved successfully');
    }

    /**
     * Update the specified Faq in storage.
     * PUT/PATCH /faqs/{id}
     *
     * @param  int $id
     * @param UpdateFaqAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFaqAPIRequest $request)
    {
        $input = $request->all();

        /** @var Faq $faq */
        $faq = $this->faqRepository->findWithoutFail($id);

        if (empty($faq)) {
            return $this->sendError('Faq not found');
        }

        $faq = $this->faqRepository->update($input, $id);

        return $this->sendResponse($faq->toArray(), 'Faq updated successfully');
    }

    /**
     * Remove the specified Faq from storage.
     * DELETE /faqs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Faq $faq */
        $faq = $this->faqRepository->findWithoutFail($id);

        if (empty($faq)) {
            return $this->sendError('Faq not found');
        }

        $faq->delete();

        return $this->sendResponse($id, 'Faq deleted successfully');
    }
}
