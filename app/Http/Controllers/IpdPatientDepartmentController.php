<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIpdPatientDepartmentRequest;
use App\Http\Requests\UpdateIpdPatientDepartmentRequest;
use App\Models\IpdCharge;
use App\Models\IpdPatientDepartment;
use App\Models\IpdPayment;
use App\Models\User;
use App\Queries\IpdPatientDepartmentDataTable;
use App\Repositories\IpdBillRepository;
use App\Repositories\IpdPatientDepartmentRepository;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class IpdPatientDepartmentController extends AppBaseController
{
    /** @var IpdPatientDepartmentRepository */
    private $ipdPatientDepartmentRepository;

    public function __construct(IpdPatientDepartmentRepository $ipdPatientDepartmentRepo)
    {
        $this->ipdPatientDepartmentRepository = $ipdPatientDepartmentRepo;
    }

    /**
     * Display a listing of the IpdPatientDepartment.
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
            return Datatables::of((new IpdPatientDepartmentDataTable())
                ->get($request->only(['status'])))
                ->addColumn(User::IMG_COLUMN,
                    function (IpdPatientDepartment $ipdPatientDepartment) {
                        return $ipdPatientDepartment->patient->user->image_url;
                    })->addColumn('doctorImageUrl', function (IpdPatientDepartment $ipdPatientDepartment) {
                    return $ipdPatientDepartment->doctor->user->image_url;
                })->make(true);
        }
        $statusArr = IpdPatientDepartment::STATUS_ARR;

        return view('ipd_patient_departments.index', compact('statusArr'));
    }

    /**
     * Show the form for creating a new IpdPatientDepartment.
     *
     * @return Factory|View
     */
    public function create()
    {
        $data = $this->ipdPatientDepartmentRepository->getAssociatedData();

        return view('ipd_patient_departments.create', compact('data'));
    }

    /**
     * Store a newly created IpdPatientDepartment in storage.
     *
     * @param  CreateIpdPatientDepartmentRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreateIpdPatientDepartmentRequest $request)
    {
        $input = $request->all();
        $this->ipdPatientDepartmentRepository->store($input);
        $this->ipdPatientDepartmentRepository->createNotification($input);
        Flash::success('IPD Patient saved successfully.');

        return redirect(route('ipd.patient.index'));
    }

    /**
     * Display the specified IpdPatientDepartment.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function show($id)
    {
        $ipdPatientDepartment = IpdPatientDepartment::findOrFail($id);
        $doctors = $this->ipdPatientDepartmentRepository->getDoctorsData();
        $doctorsList = $this->ipdPatientDepartmentRepository->getDoctorsList();
        $medicineCategories = $this->ipdPatientDepartmentRepository->getMedicinesCategoriesData();
        $medicineCategoriesList = $this->ipdPatientDepartmentRepository->getMedicineCategoriesList();
        $ipdPatientDepartmentRepository = App::make(IpdBillRepository::class);
        $bill = $ipdPatientDepartmentRepository->getBillList($ipdPatientDepartment);
        $chargeTypes = IpdCharge::CHARGE_TYPES;
        $paymentModes = IpdPayment::PAYMENT_MODES;

        return view('ipd_patient_departments.show',
            compact('ipdPatientDepartment', 'doctors', 'doctorsList', 'chargeTypes', 'medicineCategories',
                'medicineCategoriesList', 'paymentModes', 'bill'));
    }

    /**
     * Show the form for editing the specified Ipd Diagnosis.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $ipdPatientDepartment = IpdPatientDepartment::findOrFail($id);
        $data = $this->ipdPatientDepartmentRepository->getAssociatedData();

        return view('ipd_patient_departments.edit', compact('data', 'ipdPatientDepartment'));
    }

    /**
     * Update the specified Ipd Diagnosis in storage.
     *
     * @param  IpdPatientDepartment  $ipdPatientDepartment
     *
     * @param  UpdateIpdPatientDepartmentRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function update(IpdPatientDepartment $ipdPatientDepartment, UpdateIpdPatientDepartmentRequest $request)
    {
        $input = $request->all();
        $this->ipdPatientDepartmentRepository->updateIpdPatientDepartment($input, $ipdPatientDepartment);
        Flash::success('IPD Patient updated successfully.');

        return redirect(route('ipd.patient.index'));
    }

    /**
     * Remove the specified IpdPatientDepartment from storage.
     *
     * @param  IpdPatientDepartment  $ipdPatientDepartment
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(IpdPatientDepartment $ipdPatientDepartment)
    {
        $this->ipdPatientDepartmentRepository->deleteIpdPatientDepartment($ipdPatientDepartment);

        return $this->sendSuccess('IPD Patient deleted successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function getPatientCasesList(Request $request)
    {
        $patientCases = $this->ipdPatientDepartmentRepository->getPatientCases($request->get('id'));

        return $this->sendResponse($patientCases, 'Retrieved successfully');
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function getPatientBedsList(Request $request)
    {
        $patientBeds = $this->ipdPatientDepartmentRepository->getPatientBeds($request->get('id'),
            $request->get('isEdit'), $request->get('bedId'), $request->get('ipdPatientBedTypeId'));

        return $this->sendResponse($patientBeds, 'Retrieved successfully');
    }
}
