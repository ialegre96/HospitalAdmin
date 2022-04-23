<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateServiceSliderRequest;
use App\Models\ServiceSlider;
use App\Queries\ServiceSliderDataTable;
use App\Repositories\ServiceSliderRepository;
use DataTables;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class ServiceSliderController extends AppBaseController
{
    /**
     * @var ServiceSliderRepository
     */
    protected $serviceSliderRepo;

    /**
     * @param  ServiceSliderRepository  $serviceSliderRepository
     */
    public function __construct(ServiceSliderRepository $serviceSliderRepository)
    {
        $this->serviceSliderRepo = $serviceSliderRepository;;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new ServiceSliderDataTable())->get())->make(true);
        }

        return view('landing.service_slider.index');
    }

    /**
     * @param  Request  $request
     *
     * @throws FileDoesNotExist
     *
     * @throws FileIsTooBig
     *
     * @return JsonResponse
     */
    public function store(createServiceSliderRequest $request)
    {
        $input = $request->all();
        $this->serviceSliderRepo->store($input);

        return $this->sendSuccess('Service slider image created successfully.');
    }

    /**
     * @param  ServiceSlider  $serviceSlider
     *
     * @return JsonResponse
     */
    public function edit(ServiceSlider $serviceSlider)
    {
        return $this->sendResponse($serviceSlider, 'ServiceSlider retrieved successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @param $id
     *
     * @throws FileDoesNotExist
     *
     * @throws FileIsTooBig
     *
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $this->serviceSliderRepo->update($input, $id);

        return $this->sendSuccess('Service slider image updated successfully.');

    }

    /**
     * @param  ServiceSlider  $serviceSlider
     *
     * @return JsonResponse
     */
    public function destroy(ServiceSlider $serviceSlider)
    {
        $serviceSlider->delete();

        return $this->sendSuccess('service Slider deleted successfully.');
    }
}
