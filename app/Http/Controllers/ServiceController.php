<?php

namespace App\Http\Controllers;

use App\Exports\ServiceExport;
use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\PackageService;
use App\Models\Service;
use App\Queries\ServicesDataTable;
use App\Repositories\ServiceRepository;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ServiceController extends AppBaseController
{
    /** @var ServiceRepository */
    private $serviceRepository;

    public function __construct(ServiceRepository $serviceRepo)
    {
        $this->serviceRepository = $serviceRepo;
    }

    /**
     * Display a listing of the Service.
     *
     * @param  Request  $request
     *
     * @throws Exception
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new ServicesDataTable())->get($request->only(['status'])))->make(true);
        }
        $data['statusArr'] = Service::STATUS_ARR;

        return view('services.index', $data);
    }

    /**
     * Show the form for creating a new Service.
     * @return Factory|View
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created Service in storage.
     *
     * @param  CreateServiceRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreateServiceRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;
        $input['rate'] = removeCommaFromNumbers($input['rate']);
        $this->serviceRepository->create($input);
        $this->serviceRepository->createNotification();
        Flash::success('Service saved successfully.');

        return redirect(route('services.index'));
    }

    /**
     * @param  Service  $service
     *
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function show(Service $service)
    {
        $service = $this->serviceRepository->find($service->id);
        if (empty($service)) {
            Flash::error('Service not found');

            return redirect(route('services.index'));
        }

        return view('services.show')->with('service', $service);
    }

    /**
     * Show the form for editing the specified Service.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);

        return view('services.edit', compact('service'));
    }

    /**
     * @param  Service  $service
     * @param  UpdateServiceRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Service $service, UpdateServiceRequest $request)
    {
        if (empty($service)) {
            Flash::error('Service not found');

            return redirect(route('services.index'));
        }
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;
        $input['rate'] = removeCommaFromNumbers($input['rate']);
        $this->serviceRepository->update($input, $service->id);
        Flash::success('Service updated successfully.');

        return redirect(route('services.index'));
    }

    /**
     * Remove the specified Service from storage.
     *
     * @param  Service  $service
     *
     * @throws Exception
     * @return JsonResponse
     */
    public function destroy(Service $service)
    {
        $serviceModel = [
            PackageService::class,
        ];
        $result = canDelete($serviceModel, 'service_id', $service->id);
        if ($result) {
            return $this->sendError('Service can\'t be deleted.');
        }
        $service->delete();

        return $this->sendSuccess('Service deleted successfully.');
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     */
    public function activeDeActiveService($id)
    {
        $service = Service::findOrFail($id);
        $service->status = ! $service->status;
        $service->update(['status' => $service->status]);

        return $this->sendSuccess('Service updated successfully.');
    }

    /**
     * @return BinaryFileResponse
     */
    public function serviceExport()
    {
        return Excel::download(new ServiceExport, 'services-'.time().'.xlsx');
    }
}
