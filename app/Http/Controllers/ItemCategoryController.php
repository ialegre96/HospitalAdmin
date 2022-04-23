<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateItemCategoryRequest;
use App\Http\Requests\UpdateItemCategoryRequest;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Queries\ItemCategoryDataTable;
use App\Repositories\ItemCategoryRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ItemCategoryController extends AppBaseController
{
    /** @var ItemCategoryRepository */
    private $itemCategoryRepository;

    public function __construct(ItemCategoryRepository $itemCategoryRepo)
    {
        $this->middleware('check_menu_access');
        $this->itemCategoryRepository = $itemCategoryRepo;
    }

    /**
     * Display a listing of the ItemCategory.
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
            return Datatables::of((new ItemCategoryDataTable())->get())->make(true);
        }

        return view('item_categories.index');
    }

    /**
     * Store a newly created ItemCategory in storage.
     *
     * @param  CreateItemCategoryRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateItemCategoryRequest $request)
    {
        $input = $request->all();
        $this->itemCategoryRepository->create($input);

        return $this->sendSuccess('Item Category saved successfully.');
    }

    /**
     * Show the form for editing the specified ItemCategory.
     *
     * @param  ItemCategory  $itemCategory
     *
     * @return JsonResponse
     */
    public function edit(ItemCategory $itemCategory)
    {
        return $this->sendResponse($itemCategory, 'Item Category retrieved successfully.');
    }

    /**
     * Update the specified ItemCategory in storage.
     *
     * @param  ItemCategory  $itemCategory
     * @param  UpdateItemCategoryRequest  $request
     *
     * @return JsonResponse
     */
    public function update(ItemCategory $itemCategory, UpdateItemCategoryRequest $request)
    {
        $input = $request->all();
        $this->itemCategoryRepository->update($input, $itemCategory->id);

        return $this->sendSuccess('Item Category updated successfully.');
    }

    /**
     * Remove the specified ItemCategory from storage.
     *
     * @param  ItemCategory  $itemCategory
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(ItemCategory $itemCategory)
    {
        $itemCategoryModel = [Item::class];
        $result = canDelete($itemCategoryModel, 'item_category_id', $itemCategory->id);
        if ($result) {
            return $this->sendError('Item Category can\'t be deleted.');
        }
        $this->itemCategoryRepository->delete($itemCategory->id);

        return $this->sendSuccess('Item Category deleted successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function getItemsList(Request $request)
    {
        if (empty($request->get('id'))) {
            return $this->sendError('Items not found');
        }

        $itemsData = Item::get()->where('item_category_id', $request->get('id'))->pluck('name', 'id');

        return $this->sendResponse($itemsData, 'Retrieved successfully');
    }
}
