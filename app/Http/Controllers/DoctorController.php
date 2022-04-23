<?php

namespace App\Http\Controllers;

use App\Exports\DoctorExport;
use App\Http\Requests\CreateDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Appointment;
use App\Models\BirthReport;
use App\Models\DeathReport;
use App\Models\Doctor;
use App\Models\EmployeePayroll;
use App\Models\InvestigationReport;
use App\Models\IpdPatientDepartment;
use App\Models\OperationReport;
use App\Models\PatientAdmission;
use App\Models\PatientCase;
use App\Models\Prescription;
use App\Models\Schedule;
use App\Models\User;
use App\Queries\DoctorDataTable;
use App\Repositories\DoctorRepository;
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

class DoctorController extends AppBaseController
{
    /** @var DoctorRepository */
    private $doctorRepository;

    public function __construct(DoctorRepository $doctorRepo)
    {
        $this->doctorRepository = $doctorRepo;
    }

    /**
     * Display a listing of the Doctor.
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
            return Datatables::of((new DoctorDataTable())->get($request->only(['status'])))
                ->addColumn(User::IMG_COLUMN, function (Doctor $doctor) {
                    return $doctor->user->image_url;
                })->make(true);
        }
        $data['statusArr'] = Doctor::STATUS_ARR;

        return view('doctors.index', $data);
    }

    /**
     * Show the form for creating a new Doctor.
     *
     * @return Factory|View
     */
    public function create()
    {
        $doctorsDepartments = getDoctorsDepartments();
        $bloodGroup = getBloodGroups();

        return view('doctors.create', compact('doctorsDepartments', 'bloodGroup'));
    }

    /**
     * Store a newly created Doctor in storage.
     *
     * @param  CreateDoctorRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(CreateDoctorRequest $request)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;
        $doctor = $this->doctorRepository->store($input);
        Flash::success('Doctor saved successfully.');

        return redirect(route('doctors.index'));
    }

    /**
     * @param  int  $doctorId
     *
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function show($doctorId)
    {
        $doctor = Doctor::find($doctorId);
        if (empty($doctor)) {
            Flash::error('Doctor not found');

            return redirect(route('doctors.index'));
        }
        $data = $this->doctorRepository->getDoctorAssociatedData($doctorId);

        return view('doctors.show')->with($data);
    }

    /**
     * Show the form for editing the specified Doctor.
     *
     * @param  int  $id
     *
     * @return Factory|View
     */
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        $user = $doctor->user;
        $doctorsDepartments = getDoctorsDepartments();
        $bloodGroup = getBloodGroups();

        return view('doctors.edit', compact('doctor', 'user', 'doctorsDepartments', 'bloodGroup'));
    }

    /**
     * Update the specified Doctor in storage.
     *
     * @param  Doctor  $doctor
     * @param  UpdateDoctorRequest  $request
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Doctor $doctor, UpdateDoctorRequest $request)
    {
        if (empty($doctor)) {
            Flash::error('Doctor not found');

            return redirect(route('doctors.index'));
        }
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;
        $doctor = $this->doctorRepository->update($doctor, $input);
        Flash::success('Doctor updated successfully.');

        return redirect(route('doctors.index'));
    }

    /**
     * Remove the specified Doctor from storage.
     *
     * @param  Doctor  $doctor
     *
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(Doctor $doctor)
    {
        $doctorModels = [
            PatientCase::class, PatientAdmission::class, Schedule::class, Appointment::class, BirthReport::class,
            DeathReport::class, InvestigationReport::class, OperationReport::class, Prescription::class,
            IpdPatientDepartment::class,
        ];
        $result = canDelete($doctorModels, 'doctor_id', $doctor->id);
        $empPayRollResult = canDeletePayroll(EmployeePayroll::class, 'owner_id', $doctor->id);
        if ($result || $empPayRollResult) {
            return $this->sendError('Doctor can\'t be deleted.');
        }
        $doctor->user()->delete();
        $doctor->address()->delete();
        $doctor->delete();

        return $this->sendSuccess('Doctor deleted successfully.');
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function activeDeactiveStatus($id)
    {
        $doctor = Doctor::findOrFail($id);
        $status = ! $doctor->user->status;
        $doctor->user()->update(['status' => $status]);

        return $this->sendSuccess('Status updated successfully.');
    }

    /**
     * @return BinaryFileResponse
     */
    public function doctorExport()
    {
        return Excel::download(new DoctorExport, 'doctors-'.time().'.xlsx');
    }
}
