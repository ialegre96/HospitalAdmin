<?php

namespace App\Http\Controllers;

use App\Exports\BrandExport;
use App\Http\Requests\CreateBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Models\Medicine;
use App\Queries\BrandDataTable;
use App\Repositories\BrandRepository;
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
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BrandController extends AppBaseController
{
    /** @var BrandRepository */
    private $brandRepository;

    public function __construct(BrandRepository $brandRepo)
    {
        $this->brandRepository = $brandRepo;
    }

    /**
     * Display a listing of the Brand.
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
            return Datatables::of((new BrandDataTable())->get())->make(true);
        }

        return view('brands.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Store a newly created Brand in storage.
     *
     * @param  CreateBrandRequest  $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateBrandRequest $request)
    {
        $input = $request->all();
        $input['phone'] = preparePhoneNumber($input, 'phone');
        $this->brandRepository->create($input);
        Flash::success('Medicine brand saved successfully.');

        return redirect(route('brands.index'));
    }

    /**
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        $medicines = $brand->medicines;

        return view('brands.show', compact('medicines', 'brand'));
    }

    /**
     * Show the form for editing the specified Brand.
     *
     * @param  int  $id
     *
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);

        return view('brands.edit', compact('brand'));
    }

    /**
     * Update the specified Brand in storage.
     *
     * @param  Brand  $brand
     *
     * @param  UpdateBrandRequest  $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Brand $brand, UpdateBrandRequest $request)
    {
        $input = $request->all();
        $input['phone'] = preparePhoneNumber($input, 'phone');
        $this->brandRepository->update($input, $brand->id);
        Flash::success('Medicine brand updated successfully.');

        return redirect(route('brands.index'));
    }

    /**
     * Remove the specified Brand from storage.
     *
     * @param  Brand  $brand
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(Brand $brand)
    {
        $medicineBrandModel = [
            Medicine::class,
        ];
        $result = canDelete($medicineBrandModel, 'brand_id', $brand->id);
        if ($result) {
            return $this->sendError('Medicine brand can\'t be deleted.');
        }
        $brand->delete($brand->id);

        return $this->sendSuccess('Medicine brand deleted successfully.');
    }

    /**
     * @return BinaryFileResponse
     */
    public function brandExport()
    {
        return Excel::download(new BrandExport, 'medicine-brands-'.time().'.xlsx');
    }
}
