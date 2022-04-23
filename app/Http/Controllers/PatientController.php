<?php

namespace App\Http\Controllers;

use App\Exports\PatientExport;
use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\AdvancedPayment;
use App\Models\Appointment;
use App\Models\BedAssign;
use App\Models\Bill;
use App\Models\BirthReport;
use App\Models\DeathReport;
use App\Models\InvestigationReport;
use App\Models\Invoice;
use App\Models\IpdPatientDepartment;
use App\Models\OperationReport;
use App\Models\Patient;
use App\Models\PatientAdmission;
use App\Models\PatientCase;
use App\Models\Prescription;
use App\Models\User;
use App\Models\Vaccination;
use App\Queries\PatientDataTable;
use App\Repositories\PatientRepository;
use DataTables;
use Exception;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App;
use App\Repositories\AdvancedPaymentRepository;

class PatientController extends AppBaseController
{
    /** @var PatientRepository */
    private $patientRepository;

    public function __construct(PatientRepository $patientRepo)
    {
        $this->patientRepository = $patientRepo;
    }

    /**
     * Display a listing of the Patient.
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
            return Datatables::of((new PatientDataTable())->get($request->only(['status'])))
                ->addColumn(User::IMG_COLUMN, function (Patient $patient) {
                    return $patient->user->image_url;
                })->make(true);
        }
        $data['statusArr'] = Patient::STATUS_ARR;

        return view('patients.index', $data);
    }

    /**
     * Show the form for creating a new Patient.
     *
     * @return Factory|View
     */
    public function create()
    {
        $bloodGroup = getBloodGroups();

        return view('patients.create', compact('bloodGroup'));
    }

    /**
     * Store a newly created Patient in storage.
     *
     * @param  CreatePatientRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreatePatientRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;

        $this->patientRepository->store($input);
        $this->patientRepository->createNotification($input);
        Flash::success('Patient saved successfully.');

        return redirect(route('patients.index'));
    }

    /**
     * @param  int  $patientId
     *
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function show($patientId)
    {
        $patient = Patient::find($patientId);
        if (empty($patient)) {
            Flash::error('Patient not found');

            return redirect(route('patients.index'));
        }
        $data = $this->patientRepository->getPatientAssociatedData($patientId);
        $advancedPaymentRepo = App::make(AdvancedPaymentRepository::class);
        $patients = $advancedPaymentRepo->getPatients();
        $user = Auth::user();
        if ($user->hasRole('Doctor')) {
            $vaccinationPatients = getPatientsList($user->owner_id);
        } else {
            $vaccinationPatients = Patient::getActivePatientNames();
        }
        $vaccinations = Vaccination::toBase()->pluck('name', 'id')->toArray();
        natcasesort($vaccinations);

        return view('patients.show', compact('data', 'patients', 'vaccinations', 'vaccinationPatients'));
    }

    /**
     * Show the form for editing the specified Patient.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        $user = $patient->user;
        $bloodGroup = getBloodGroups();

        return view('patients.edit', compact('patient', 'user', 'bloodGroup'));
    }

    /**
     * @param  Patient  $patient
     * @param  UpdatePatientRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Patient $patient, UpdatePatientRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;
        $this->patientRepository->update($input, $patient);

        Flash::success('Patient updated successfully.');

        return redirect(route('patients.index'));
    }

    /**
     * Remove the specified Patient from storage.
     *
     * @param  Patient  $patient
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(Patient $patient)
    {
        $patientModels = [
            BirthReport::class, DeathReport::class, InvestigationReport::class, OperationReport::class,
            Appointment::class, BedAssign::class, PatientAdmission::class, PatientCase::class, Bill::class,
            Invoice::class, AdvancedPayment::class, Prescription::class, IpdPatientDepartment::class,
        ];
        $result = canDelete($patientModels, 'patient_id', $patient->id);
        if ($result) {
            return $this->sendError('Patient can\'t be deleted.');
        }
        $patient->user()->delete();
        $patient->address()->delete();
        $patient->delete();

        return $this->sendSuccess('Patient deleted successfully.');
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function activeDeactiveStatus($id)
    {
        $patient = Patient::findOrFail($id);
        $status = ! $patient->user->status;
        $patient->user()->update(['status' => $status]);

        return $this->sendSuccess('Status updated successfully.');
    }

    /**
     * @return BinaryFileResponse
     */
    public function patientExport()
    {
        return Excel::download(new PatientExport, 'patients-' . time() . '.xlsx');
    }

    /**
     * @param $id
     * @return Patient|Builder|Model|object|null
     */
    public function getBirthDate($id)
    {
        return Patient::whereId($id)->with('user')->first();
    }

}
