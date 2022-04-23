<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRadiologyCategoryRequest;
use App\Http\Requests\UpdateRadiologyCategoryRequest;
use App\Models\RadiologyCategory;
use App\Models\RadiologyTest;
use App\Queries\RadiologyCategoryDataTable;
use App\Repositories\RadiologyCategoryRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RadiologyCategoryController extends AppBaseController
{
    /** @var RadiologyCategoryRepository */
    private $radiologyCategoryRepository;

    public function __construct(RadiologyCategoryRepository $radiologyCategoryRepo)
    {
        $this->middleware('check_menu_access');
        $this->radiologyCategoryRepository = $radiologyCategoryRepo;
    }

    /**
     * Display a listing of the RadiologyCategory.
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
            return Datatables::of((new RadiologyCategoryDataTable())->get())->make(true);
        }

        return view('radiology_categories.index');
    }

    /**
     * Store a newly created RadiologyCategory in storage.
     *
     * @param  CreateRadiologyCategoryRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateRadiologyCategoryRequest $request)
    {
        $input = $request->all();
        $this->radiologyCategoryRepository->create($input);

        return $this->sendSuccess('Radiology Category saved successfully.');
    }

    /**
     * Show the form for editing the specified RadiologyCategory.
     *
     * @param  RadiologyCategory  $radiologyCategory
     *
     * @return JsonResponse
     */
    public function edit(RadiologyCategory $radiologyCategory)
    {
        return $this->sendResponse($radiologyCategory, 'Radiology Category retrieved successfully.');
    }

    /**
     * Update the specified RadiologyCategory in storage.
     *
     * @param  RadiologyCategory  $radiologyCategory
     * @param  UpdateRadiologyCategoryRequest  $request
     *
     * @return JsonResponse
     */
    public function update(RadiologyCategory $radiologyCategory, UpdateRadiologyCategoryRequest $request)
    {
        $input = $request->all();
        $this->radiologyCategoryRepository->update($input, $radiologyCategory->id);

        return $this->sendSuccess('Radiology Category updated successfully.');
    }

    /**
     * Remove the specified RadiologyCategory from storage.
     *
     * @param  RadiologyCategory  $radiologyCategory
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(RadiologyCategory $radiologyCategory)
    {
        $radiologyCategoryModels = [
            RadiologyTest::class,
        ];
        $result = canDelete($radiologyCategoryModels, 'category_id', $radiologyCategory->id);
        if ($result) {
            return $this->sendError('Radiology Category can\'t be deleted.');
        }

        $radiologyCategory->delete();

        return $this->sendSuccess('Radiology Category deleted successfully.');
    }
}
