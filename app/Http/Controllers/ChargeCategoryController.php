<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChargeCategoryRequest;
use App\Http\Requests\UpdateChargeCategoryRequest;
use App\Models\ChargeCategory;
use App\Models\RadiologyTest;
use App\Queries\ChargeCategoryDataTable;
use App\Repositories\ChargeCategoryRepository;
use Exception;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class ChargeCategoryController extends AppBaseController
{
    /** @var ChargeCategoryRepository */
    private $chargeCategoryRepository;

    public function __construct(ChargeCategoryRepository $chargeCategoryRepo)
    {
        $this->chargeCategoryRepository = $chargeCategoryRepo;
    }

    /**
     * Display a listing of the ChargeCategory.
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
            return DataTables::of((new ChargeCategoryDataTable())->get())->make(true);
        }

        $chargeTypes = ChargeCategory::CHARGE_TYPES;
        asort($chargeTypes);

        return view('charge_categories.index', compact('chargeTypes'));
    }

    /**
     * Store a newly created ChargeCategory in storage.
     *
     * @param  CreateChargeCategoryRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateChargeCategoryRequest $request)
    {
        $input = $request->all();

        $chargeCategory = $this->chargeCategoryRepository->create($input);

        return $this->sendSuccess('Charge Category saved successfully.');
    }

    /**
     * Display the specified ChargeCategory.
     *
     * @param  int  $id
     *
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function show($id)
    {
        $chargeCategory = ChargeCategory::find($id);
        if (empty($chargeCategory)) {
            Flash::error('Charge Category not found');

            return redirect(route('charge-categories.index'));
        }
        $chargeTypes = ChargeCategory::CHARGE_TYPES;

        return view('charge_categories.show', compact('chargeCategory', 'chargeTypes'));
    }

    /**
     * Show the form for editing the specified ChargeCategory.
     *
     * @param  ChargeCategory  $chargeCategory
     *
     * @return JsonResponse
     */
    public function edit(ChargeCategory $chargeCategory)
    {
        return $this->sendResponse($chargeCategory, 'Charge Category Retrieved Successfully.');
    }

    /**
     * Update the specified ChargeCategory in storage.
     *
     * @param  ChargeCategory  $chargeCategory
     * @param  UpdateChargeCategoryRequest  $request
     *
     * @return JsonResponse
     */
    public function update(ChargeCategory $chargeCategory, UpdateChargeCategoryRequest $request)
    {
        $chargeCategory = $this->chargeCategoryRepository->update($request->all(), $chargeCategory->id);

        return $this->sendSuccess('Charge Category updated successfully.');
    }

    /**
     * Remove the specified ChargeCategory from storage.
     *
     * @param  ChargeCategory  $chargeCategory
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(ChargeCategory $chargeCategory)
    {
        $chargeCategoryModels = [
            RadiologyTest::class,
        ];
        $result = canDelete($chargeCategoryModels, 'charge_category_id', $chargeCategory->id);
        if ($result) {
            return $this->sendError('Charge Category can\'t be deleted.');
        }
        $this->chargeCategoryRepository->delete($chargeCategory->id);

        return $this->sendSuccess('Charge Category deleted successfully.');
    }
}
