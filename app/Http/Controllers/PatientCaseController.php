<?php

namespace App\Http\Controllers;

use App\Exports\PatientCaseExport;
use App\Http\Requests\CreatePatientCaseRequest;
use App\Http\Requests\UpdatePatientCaseRequest;
use App\Models\BedAssign;
use App\Models\BirthReport;
use App\Models\DeathReport;
use App\Models\IpdPatientDepartment;
use App\Models\OperationReport;
use App\Models\Patient;
use App\Models\PatientCase;
use App\Queries\PatientCaseDataTable;
use App\Repositories\PatientCaseRepository;
use Carbon\Carbon;
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

class PatientCaseController extends AppBaseController
{
    /** @var PatientCaseRepository */
    private $patientCaseRepository;

    public function __construct(PatientCaseRepository $patientCaseManagerRepo)
    {
        $this->patientCaseRepository = $patientCaseManagerRepo;
    }

    /**
     * Display a listing of the PatientCase.
     *
     * @param  Request  $request
     *
     * @throws Exception
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new PatientCaseDataTable())->get($request->only(['status'])))
                ->addColumn('patientImageUrl', function (PatientCase $patientCase) {
                    return $patientCase->patient->user->image_url;
                })->addColumn('doctorImageUrl', function (PatientCase $patientCase) {
                    return $patientCase->doctor->user->image_url;
                })->make(true);
        }
        $data['statusArr'] = PatientCase::STATUS_ARR;

        return view('patient_cases.index', $data);
    }

    /**
     * Show the form for creating a new PatientCase.
     * @return Factory|View
     */
    public function create()
    {
        $patients = $this->patientCaseRepository->getPatients();
        $doctors = $this->patientCaseRepository->getDoctors();

        return view('patient_cases.create', compact('patients', 'doctors'));
    }

    /**
     * Store a newly created PatientCase in storage.
     *
     * @param  CreatePatientCaseRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreatePatientCaseRequest $request)
    {
        $input = $request->all();
        $patientId = Patient::with('user')->whereId($input['patient_id'])->first();
        $birthDate = $patientId->user->dob;
        $caseDate = Carbon::parse($input['date'])->toDateString();
        if (! empty($birthDate) && $caseDate < $birthDate) {
            Flash::error('Case date should not be smaller than patient birth date.');

            return redirect()->back()->withInput($input);
        }

        $input['fee'] = removeCommaFromNumbers($input['fee']);
        $input['status'] = isset($input['status']) ? 1 : 0;
        $input['phone'] = preparePhoneNumber($input, 'phone');

        $this->patientCaseRepository->store($input);
        $this->patientCaseRepository->createNotification($input);

        Flash::success('Case saved successfully.');

        return redirect(route('patient-cases.index'));
    }

    /**
     * Display the specified PatientCase.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function show($id)
    {
        $patientCase = PatientCase::findOrFail($id);

        return view('patient_cases.show')->with('patientCase', $patientCase);
    }

    /**
     * Show the form for editing the specified PatientCase.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $patientCase = PatientCase::findOrFail($id);
        $patients = $this->patientCaseRepository->getPatients();
        $doctors = $this->patientCaseRepository->getDoctors();

        return view('patient_cases.edit', compact('patientCase', 'patients', 'doctors'));
    }

    /**
     * Update the specified PatientCase in storage.
     *
     * @param  PatientCase  $patientCase
     * @param  UpdatePatientCaseRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function update(PatientCase $patientCase, UpdatePatientCaseRequest $request)
    {
        $input = $request->all();
        $patientId = Patient::with('user')->whereId($input['patient_id'])->first();
        $birthDate = $patientId->user->dob;
        $caseDate = Carbon::parse($input['date'])->toDateString();
        if (! empty($birthDate) && $caseDate < $birthDate) {
            Flash::error('Case date should not be smaller than patient birth date.');

            return redirect()->back()->withInput($input);
        }
        $input['fee'] = removeCommaFromNumbers($input['fee']);
        $input['status'] = isset($input['status']) ? 1 : 0;
        $input['phone'] = preparePhoneNumber($input, 'phone');

        $patientCase = $this->patientCaseRepository->update($input, $patientCase->id);

        Flash::success('Case updated successfully.');

        return redirect(route('patient-cases.index'));
    }

    /**
     * Remove the specified PatientCase from storage.
     *
     * @param  PatientCase  $patientCase
     *
     * @return JsonResponse
     * @throws Exception
     *
     */
    public function destroy(PatientCase $patientCase)
    {
        $patientCaseModel = [
            BedAssign::class, BirthReport::class, DeathReport::class, OperationReport::class,
            IpdPatientDepartment::class,
        ];
        $result = canDelete($patientCaseModel, 'case_id', $patientCase->case_id);
        if ($result) {
            return $this->sendError('Case can\'t be deleted.');
        }
        $this->patientCaseRepository->delete($patientCase->id);

        return $this->sendSuccess('Case deleted successfully.');
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function activeDeActiveStatus($id)
    {
        $patientCase = PatientCase::findOrFail($id);
        $patientCase->status = ! $patientCase->status;
        $patientCase->update(['status' => $patientCase->status]);

        return $this->sendSuccess('Status updated successfully.');
    }

    /**
     * @return BinaryFileResponse
     */
    public function patientCaseExport()
    {
        return Excel::download(new PatientCaseExport, 'patient-cases-'.time().'.xlsx');
    }

    /**
     * @param  PatientCase  $patientCase
     *
     * @return JsonResponse
     */
    public function showModal(PatientCase $patientCase)
    {
        $patientCase->load(['patient.user', 'doctor.user']);
        
        return $this->sendResponse($patientCase, 'Patient Case Retrieved Successfully.');
    }
}
