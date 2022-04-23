<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePrescriptionRequest;
use App\Http\Requests\UpdatePrescriptionRequest;
use App\Models\Prescription;
use App\Models\User;
use App\Queries\PrescriptionDataTable;
use App\Repositories\DoctorRepository;
use App\Repositories\PrescriptionRepository;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class PrescriptionController extends AppBaseController
{
    /** @var  PrescriptionRepository
     * @var DoctorRepository
     */
    private $prescriptionRepository;
    private $doctorRepository;

    public function __construct(
        PrescriptionRepository $prescriptionRepo,
        DoctorRepository $doctorRepository
    ) {
        $this->prescriptionRepository = $prescriptionRepo;
        $this->doctorRepository = $doctorRepository;
    }

    /**
     * Display a listing of the Prescription.
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
            return Datatables::of((new PrescriptionDataTable())->get($request->only(['status'])))->addColumn(User::IMG_COLUMN,
                function (Prescription $prescription) {
                    return $prescription->patient->user->image_url;
                })->addColumn('doctorImageUrl', function (Prescription $prescription) {
                return $prescription->doctor->user->image_url;
            })->make(true);
        }

        $data['statusArr'] = Prescription::STATUS_ARR;

        return view('prescriptions.index', $data);
    }

    /**
     * Show the form for creating a new Prescription.
     *
     * @return Factory|View
     */
    public function create()
    {
        $patients = $this->prescriptionRepository->getPatients();
        $doctors = $this->doctorRepository->getDoctors();

        return view('prescriptions.create', compact('patients', 'doctors'));
    }

    /**
     * Store a newly created Prescription in storage.
     *
     * @param  CreatePrescriptionRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreatePrescriptionRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;
        $this->prescriptionRepository->create($input);
        $this->prescriptionRepository->createNotification($input);
        Flash::success('Prescription saved successfully.');

        return redirect(route('prescriptions.index'));
    }

    /**
     * @param  Prescription  $prescription
     *
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function show(Prescription $prescription)
    {
        $prescription = $this->prescriptionRepository->find($prescription->id);
        if (empty($prescription)) {
            Flash::error('Prescription not found');

            return redirect(route('prescriptions.index'));
        }

        return view('prescriptions.show')->with('prescription', $prescription);
    }

    /**
     * @param  int  $id
     *
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function edit($id)
    {
        $prescription = Prescription::findOrFail($id);
        $patients = $this->prescriptionRepository->getPatients();
        $doctors = $this->doctorRepository->getDoctors();

        return view('prescriptions.edit', compact('patients', 'prescription', 'doctors'));
    }

    /**
     * @param  Prescription  $prescription
     * @param  UpdatePrescriptionRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Prescription $prescription, UpdatePrescriptionRequest $request)
    {
        $prescription = $this->prescriptionRepository->find($prescription->id);
        if (empty($prescription)) {
            Flash::error('Prescription not found');

            return redirect(route('prescriptions.index'));
        }
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;
        $this->prescriptionRepository->update($prescription, $input);
        Flash::success('Prescription updated successfully.');

        return redirect(route('prescriptions.index'));
    }

    /**
     * @param  Prescription  $prescription
     *
     * @throws Exception
     *
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function destroy(Prescription $prescription)
    {
        $prescription = $this->prescriptionRepository->find($prescription->id);
        if (empty($prescription)) {
            Flash::error('Prescription not found');

            return redirect(route('prescriptions.index'));
        }
        $prescription->delete();

        return $this->sendSuccess('Prescription deleted successfully.');
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function activeDeactiveStatus($id)
    {
        $prescription = Prescription::findOrFail($id);
        $status = ! $prescription->status;
        $prescription->update(['status' => $status]);

        return $this->sendSuccess('Status updated successfully.');
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     */
    public function showModal($id)
    {
        $prescription = $this->prescriptionRepository->find($id);
        $prescription->load(['patient.user', 'doctor.user']);
        if (empty($prescription)) {
            return $this->sendError('Prescription Not Found');
        }
        
        return $this->sendResponse($prescription, 'Prescription Retrieved Successfully');
    }
}
