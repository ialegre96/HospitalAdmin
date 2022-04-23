<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Medicine;
use App\Queries\CategoryDataTable;
use App\Repositories\CategoryRepository;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class CategoryController extends AppBaseController
{
    /** @var CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Category.
     *
     * @param  Request  $request
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new CategoryDataTable())->get($request->only(['is_active'])))->make(true);
        }
        $data['statusArr'] = Category::STATUS_ARR;

        return view('categories.index', $data);
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param  CreateCategoryRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateCategoryRequest $request)
    {
        $input = $request->all();
        $input['is_active'] = ! isset($input['is_active']) ? false : true;
        $this->categoryRepository->create($input);

        return $this->sendSuccess('Medicine category saved successfully.');
    }

    /**
     * @param  int  $id
     *
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function show($id)
    {
        $category = Category::find($id);
        if (empty($category)) {
            Flash::error('Medicine Category not found');

            return redirect(route('categories.index'));
        }
        $medicines = $category->medicines;

        return view('categories.show', compact('medicines', 'category'));
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param  Category  $category
     *
     * @return JsonResponse
     */
    public function edit(Category $category)
    {
        return $this->sendResponse($category, 'Medicine category retrieved successfully.');
    }

    /**
     * Update the specified Category in storage.
     *
     * @param  Category  $category
     * @param  UpdateCategoryRequest  $request
     *
     * @return JsonResponse
     */
    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $input = $request->all();
        $input['is_active'] = ! isset($input['is_active']) ? false : true;
        $this->categoryRepository->update($input, $category->id);

        return $this->sendSuccess('Medicine category updated successfully.');
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param  Category  $category
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(Category $category)
    {
        $medicineCategoryModel = [
            Medicine::class,
        ];
        $result = canDelete($medicineCategoryModel, 'category_id', $category->id);
        if ($result) {
            return $this->sendError('Medicine Category can\'t be deleted.');
        }
        $this->categoryRepository->delete($category->id);

        return $this->sendSuccess('Medicine category deleted successfully.');
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function activeDeActiveCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->is_active = ! $category->is_active;
        $category->save();

        return $this->sendSuccess('Medicine category updated successfully.');
    }
}
