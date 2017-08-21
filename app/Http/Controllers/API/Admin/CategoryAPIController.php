<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Requests\API\Admin\CreateCategoryAPIRequest;
use App\Http\Requests\API\Admin\UpdateCategoryAPIRequest;
use App\Models\Admin\Category;
use App\Repositories\Admin\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CategoryController
 * @package App\Http\Controllers\API\Admin
 */

class CategoryAPIController extends AppBaseController
{
    /** @var  CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Category.
     * GET|HEAD /categories
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->categoryRepository->pushCriteria(new RequestCriteria($request));
        $this->categoryRepository->pushCriteria(new LimitOffsetCriteria($request));
        $categories = $this->categoryRepository->all();

        return $this->sendResponse($categories->toArray(), 'Categories retrieved successfully');
    }

    /**
     * Store a newly created Category in storage.
     * POST /categories
     *
     * @param CreateCategoryAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryAPIRequest $request)
    {
        $input = $request->all();

        $categories = $this->categoryRepository->create($input);

        return $this->sendResponse($categories->toArray(), 'Category saved successfully');
    }

    /**
     * Display the specified Category.
     * GET|HEAD /categories/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Category $category */
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            return $this->sendError('Category not found');
        }

        return $this->sendResponse($category->toArray(), 'Category retrieved successfully');
    }

    /**
     * Update the specified Category in storage.
     * PUT/PATCH /categories/{id}
     *
     * @param  int $id
     * @param UpdateCategoryAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var Category $category */
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            return $this->sendError('Category not found');
        }

        $category = $this->categoryRepository->update($input, $id);

        return $this->sendResponse($category->toArray(), 'Category updated successfully');
    }

    /**
     * Remove the specified Category from storage.
     * DELETE /categories/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Category $category */
        $category = $this->categoryRepository->findWithoutFail($id);

        if (empty($category)) {
            return $this->sendError('Category not found');
        }

        $category->delete();

        return $this->sendResponse($id, 'Category deleted successfully');
    }
}
