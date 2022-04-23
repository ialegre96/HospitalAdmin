<?php

namespace App\Http\Controllers;

use App\Exports\AppointmentExport;
use App\Http\Requests\CreateAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use App\Queries\AppointmentDataTable;
use App\Repositories\AppointmentRepository;
use Auth;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class AppointmentController
 */
class AppointmentController extends AppBaseController
{
    /** @var AppointmentRepository */
    private $appointmentRepository;

    public function __construct(AppointmentRepository $appointmentRepo)
    {
        $this->appointmentRepository = $appointmentRepo;
    }

    /**
     * Display a listing of the appointment.
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
            return Datatables::of((new AppointmentDataTable())->get($request->only([
                'is_completed', 'start_date', 'end_date',
            ])))
                ->addColumn('patientImageUrl',
                    function (Appointment $appointment) {
                        return $appointment->patient->user->image_url;
                    })->addColumn('doctorImageUrl', function (Appointment $appointment) {
                    return $appointment->doctor->user->image_url;
                })->make(true);
        }
        $statusArr = Appointment::STATUS_ARR;

        return view('appointments.index', compact('statusArr'));
    }

    /**
     * Show the form for creating a new appointment.
     *
     * @return Factory|View
     */
    public function create()
    {
        $patients = $this->appointmentRepository->getPatients();
        $departments = $this->appointmentRepository->getDoctorDepartments();
        $statusArr = Appointment::STATUS_PENDING;

        return view('appointments.create', compact('patients', 'departments', 'statusArr'));
    }

    /**
     * Store a newly created appointment in storage.
     *
     * @param  CreateAppointmentRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateAppointmentRequest $request)
    {
        $input = $request->all();
        $input['opd_date'] = $input['opd_date'].$input['time'];
        $input['is_completed'] = isset($input['status']) ? Appointment::STATUS_COMPLETED : Appointment::STATUS_PENDING;
        if ($request->user()->hasRole('Patient')) {
            $input['patient_id'] = $request->user()->owner_id;
        }
        $this->appointmentRepository->create($input);
        $this->appointmentRepository->createNotification($input);

        return $this->sendSuccess('Appointment saved successfully.');
    }

    /**
     * Display the specified appointment.
     *
     * @param  Appointment  $appointment
     *
     * @return Factory|View|RedirectResponse
     */
    public function show(Appointment $appointment)
    {
        return view('appointments.show')->with('appointment', $appointment);
    }

    /**
     * Show the form for editing the specified appointment.
     *
     * @param  Appointment  $appointment
     *
     * @return RedirectResponse|Redirector|View
     */
    public function edit(Appointment $appointment)
    {
        $patients = $this->appointmentRepository->getPatients();
        $doctors = $this->appointmentRepository->getDoctors($appointment->department_id);
        $departments = $this->appointmentRepository->getDoctorDepartments();
        $statusArr = $appointment->is_completed;

        return view('appointments.edit', compact('appointment', 'patients', 'doctors', 'departments', 'statusArr'));
    }

    /**
     * Update the specified appointment in storage.
     *
     * @param  Appointment  $appointment
     * @param  UpdateAppointmentRequest  $request
     *
     * @return JsonResponse
     */
    public function update(Appointment $appointment, UpdateAppointmentRequest $request)
    {
        $input = $request->all();
        $input['opd_date'] = $input['opd_date'].$input['time'];
        $input['is_completed'] = isset($input['status']) ? Appointment::STATUS_COMPLETED : Appointment::STATUS_PENDING;
        if ($request->user()->hasRole('Patient')) {
            $input['patient_id'] = $request->user()->owner_id;
        }
        $appointment = $this->appointmentRepository->update($input, $appointment->id);

        return $this->sendSuccess('Appointment updated successfully.');
    }

    /**
     * Remove the specified appointment from storage.
     *
     * @param  Appointment  $appointment
     *
     * @throws Exception
     *
     * @return RedirectResponse|Redirector|JsonResponse
     */
    public function destroy(Appointment $appointment)
    {
        $this->appointmentRepository->delete($appointment->id);

        return $this->sendSuccess('Appointment deleted successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function getDoctors(Request $request)
    {
        $id = $request->get('id');

        $doctors = $this->appointmentRepository->getDoctors($id);

        return $this->sendResponse($doctors, 'Retrieved successfully');
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function getBookingSlot(Request $request)
    {
        $inputs = $request->all();
        $data = $this->appointmentRepository->getBookingSlot($inputs);

        return $this->sendResponse($data, 'Retrieved successfully');
    }

    /**
     * @return BinaryFileResponse
     */
    public function appointmentExport()
    {
        return Excel::download(new AppointmentExport, 'appointments-'.time().'.xlsx');
    }

    /**
     * @param  Appointment  $appointment
     *
     * @return JsonResponse
     */
    public function status(Appointment $appointment)
    {
        $isCompleted = ! $appointment->is_completed;
        $appointment->update(['is_completed' => $isCompleted]);

        return $this->sendSuccess('Status updated successfully.');
    }
}
