<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePathologyCategoryRequest;
use App\Http\Requests\UpdatePathologyCategoryRequest;
use App\Models\PathologyCategory;
use App\Models\PathologyTest;
use App\Queries\PathologyCategoryDataTable;
use App\Repositories\PathologyCategoryRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PathologyCategoryController extends AppBaseController
{
    /** @var PathologyCategoryRepository */
    private $pathologyCategoryRepository;

    public function __construct(PathologyCategoryRepository $pathologyCategoryRepo)
    {
        $this->middleware('check_menu_access');
        $this->pathologyCategoryRepository = $pathologyCategoryRepo;
    }

    /**
     * Display a listing of the PathologyCategory.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new PathologyCategoryDataTable())->get())->make(true);
        }

        return view('pathology_categories.index');
    }

    /**
     * Store a newly created PathologyCategory in storage.
     *
     * @param  CreatePathologyCategoryRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreatePathologyCategoryRequest $request)
    {
        $input = $request->all();
        $this->pathologyCategoryRepository->create($input);

        return $this->sendSuccess('Pathology Category saved successfully.');
    }

    /**
     * Show the form for editing the specified PathologyCategory.
     *
     * @param  PathologyCategory  $pathologyCategory
     *
     * @return JsonResponse
     */
    public function edit(PathologyCategory $pathologyCategory)
    {
        return $this->sendResponse($pathologyCategory, 'Pathology Category retrieved successfully.');
    }

    /**
     * Update the specified PathologyCategory in storage.
     *
     * @param  PathologyCategory  $pathologyCategory
     * @param  UpdatePathologyCategoryRequest  $request
     *
     * @return JsonResponse
     */
    public function update(PathologyCategory $pathologyCategory, UpdatePathologyCategoryRequest $request)
    {
        $input = $request->all();
        $this->pathologyCategoryRepository->update($input, $pathologyCategory->id);

        return $this->sendSuccess('Pathology Category updated successfully.');
    }

    /**
     * Remove the specified PathologyCategory from storage.
     *
     * @param  PathologyCategory  $pathologyCategory
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(PathologyCategory $pathologyCategory)
    {
        $pathologyCategoryModels = [
            PathologyTest::class,
        ];
        $result = canDelete($pathologyCategoryModels, 'category_id', $pathologyCategory->id);
        if ($result) {
            return $this->sendError('Pathology Category can\'t be deleted.');
        }

        $pathologyCategory->delete();

        return $this->sendSuccess('Pathology Category deleted successfully.');
    }
}
