<?php

namespace App\Http\Controllers;

use App\Exports\PackageExport;
use App\Http\Requests\CreatePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Models\Package;
use App\Models\PatientAdmission;
use App\Queries\PackageDataTable;
use App\Repositories\PackageRepository;
use DataTables;
use DB;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PackageController extends AppBaseController
{
    /** @var PackageRepository */
    private $packageRepository;

    public function __construct(PackageRepository $packageRepo)
    {
        $this->packageRepository = $packageRepo;
    }

    /**
     * Display a listing of the Package.
     *
     * @param  Request  $request
     *
     * @throws Exception
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new PackageDataTable())->get())->make(true);
        }

        return view('packages.index');
    }

    /**
     * Show the form for creating a new Package.
     * @return Factory|View
     */
    public function create()
    {
        $servicesList = $this->packageRepository->getServicesList();
        $services = $this->packageRepository->getServices();

        return view('packages.create', compact('services', 'servicesList'));
    }

    /**
     * Store a newly created Package in storage.
     *
     * @param  CreatePackageRequest  $request
     *
     * @throws Exception
     * @return JsonResponse
     */
    public function store(CreatePackageRequest $request)
    {
        try {
            DB::beginTransaction();
            $package = $this->packageRepository->store($request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($package, 'Package saved successfully.');
    }

    /**
     * @param  int  $id
     *
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function show($id)
    {
        $package = Package::with(['packageServicesItems.service'])->findOrFail($id);

        return view('packages.show')->with('package', $package);
    }

    /**
     * Show the form for editing the specified Package.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $package = Package::findOrFail($id);
        $package->packageServicesItems;
        $servicesList = $this->packageRepository->getServicesList();
        $services = $this->packageRepository->getServices();

        return view('packages.edit', compact('services', 'package', 'servicesList'));
    }

    /**
     * @param  Package  $package
     * @param  UpdatePackageRequest  $request
     *
     * @throws Exception
     * @return JsonResponse
     */
    public function update(Package $package, UpdatePackageRequest $request)
    {
        try {
            DB::beginTransaction();
            $package = $this->packageRepository->updatePackage($package->id, $request->all());
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse($package, 'Package updated successfully.');
    }

    /**
     * Remove the specified Package from storage.
     *
     * @param  Package  $package
     *
     * @throws Exception
     * @return JsonResponse
     */
    public function destroy(Package $package)
    {
        $packageModel = [
            PatientAdmission::class,
        ];
        $result = canDelete($packageModel, 'package_id', $package->id);
        if ($result) {
            return $this->sendError('Package can\'t be deleted.');
        }
        $this->packageRepository->delete($package->id);

        return $this->sendSuccess('Package deleted successfully.');
    }

    /**
     * @return BinaryFileResponse
     */
    public function packageExport()
    {
        return Excel::download(new PackageExport, 'packages-'.time().'.xlsx');
    }
}
