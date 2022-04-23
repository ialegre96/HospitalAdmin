<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateWebAppointmentRequest;
use App\Models\Patient;
use App\Models\User;
use App\Repositories\AppointmentRepository;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class AppointmentController
 */
class AppointmentController extends AppBaseController
{
    /** @var  AppointmentRepository */
    private $appointmentRepository;

    public function __construct(AppointmentRepository $appointmentRepo)
    {
        $this->appointmentRepository = $appointmentRepo;
    }

    /**
     * Store a newly created appointment in storage.
     *
     * @param  CreateWebAppointmentRequest  $request
     *
     * @return JsonResponse
     */
    public function store(CreateWebAppointmentRequest $request)
    {
        $input = $request->all();
        $input['opd_date'] = $input['opd_date'].$input['time'];
        $input['status'] = true;
        try {
            DB::beginTransaction();
            if ($input['patient_type'] == 2 && ! empty($input['patient_type'])) {
                $input['tenant_id'] = User::where('username', $input['hospital_username'])->first()->tenant_id;
                $this->appointmentRepository->create($input);
            }

            if ($input['patient_type'] == 1 && ! empty($input['patient_type'])) {
                $emailExists = User::whereEmail($input['email'])->exists();
                if ($emailExists) {
                    return $this->sendError('Email already exists, please select old patient.');
                }
                $this->appointmentRepository->createNewAppointment($input);
            }

            DB::commit();

            return $this->sendSuccess('Appointment saved successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->sendError($e->getMessage(), 404);
        }

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
     *
     * @return JsonResponse
     */
    public function getDoctorList(Request $request)
    {
        $id = $request->get('id');
        $doctorArr = $this->appointmentRepository->getDoctorList($id);

        return $this->sendResponse($doctorArr, 'Retrieved successfully');
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
     * @param $email
     *
     * @return JsonResponse
     */
    public function getPatientDetails($email)
    {
        /** @var Patient $patient */
        $patient = Patient::with('user')->get()->where('user.status', '=', 1)->where('user.email', $email)->first();
        $data = null;
        if ($patient != null) {
            $data = [
                $patient->id => $patient->user->full_name,
            ];
        }

        return $this->sendResponse($data, 'User Retrieved Successfully');
    }
}
