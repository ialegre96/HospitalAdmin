<?php

namespace App\Repositories;

use App\Mail\AppointmentReminderMail;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\DoctorDepartment;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Receptionist;
use App\Models\User;
use Arr;
use Carbon\Carbon;
use DB;
use Exception;
use Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Throwable;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Rest\Client;

/**
 * Class appointmentRepository
 * @version February 13, 2020, 5:52 am UTC
 */
class AppointmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'patient_id',
        'doctor_id',
        'department_id',
        'opd_date',
        'fee',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Appointment::class;
    }

    /**
     * @return Patient
     */
    public function getPatients()
    {
        /** @var Patient $patients */
        $patients = Patient::with('user')->get()->where('user.status', '=', 1)->pluck('user.full_name', 'id')->sort();

        return $patients;
    }

    /**
     * @param  int  $id
     *
     * @return Doctor
     */
    public function getDoctors($id) //get doctors list based on department
    {
        /** @var Doctor $doctors */
        $doctors = Doctor::with('user')->where('doctor_department_id', '=', $id)
            ->get()->where('user.status', '=', 1)->pluck('user.full_name', 'id')->sort();

        return $doctors;
    }

    /**
     * @return DoctorDepartment
     */
    public function getDoctorDepartments()
    {
        /** @var DoctorDepartment $departments */
        $departments = DoctorDepartment::all()->pluck('title', 'id')->sort();

        return $departments;
    }

    public function getDoctorDepartment($id)
    {
        /** @var DoctorDepartment $departments */
        $departments = Doctor::whereId($id)->with('department')->get();

        return $departments;
    }

    /**
     * @throws ConfigurationException
     */
    public function sendAppointmentReminder()
    {
        /** @var Appointment[] $appointments */
        $appointments = Appointment::with('patient.user', 'doctor.user')
            ->whereDate('opd_date', '=', Carbon::tomorrow()->toDateString())
            ->get();

        $sid = config('twilio.sid');
        $token = config('twilio.token');
        $client = new Client($sid, $token);

        foreach ($appointments as $appointment) {
            try {
                $input['email'] = $appointment->patient->user->email;
                $input['patient_name'] = $appointment->patient->user->full_name;
                $input['patient_phone'] = $appointment->patient->user->phone;
                $input['appointment_date'] = $appointment->opd_date;
                $input['problem'] = $appointment->problem;
                $input['doctor_name'] = $appointment->doctor->user->full_name;

                $smsMessage = 'You have an appointment tomorrow with '.$appointment->doctor->user->full_name.
                    "\n\n Appointment Time : ".Carbon::parse($appointment->opd_date)->format('jS M, Y g:i A').
                    "\n\n Thanks";

                Mail::to($input['email'])
                    ->send(new AppointmentReminderMail('emails.appointment_reminder',
                        'Doctor Appointments',
                        $input));

                $client->messages->create(
                    $input['patient_phone'],
                    [
                        'from' => config('twilio.from_number'),
                        'body' => $smsMessage,
                    ]
                );
            } catch (Exception $e) {
                throw new UnprocessableEntityHttpException($e->getMessage());
            }
        }
    }

    /**
     * @param $inputs
     *
     * @return mixed
     */
    public function getBookingSlot($inputs)
    {
        $data['bookingSlotArr'] = [];
        $bookingSlots = Appointment::whereDoctorId($inputs['doctor_id'])->whereDate('opd_date',
            $inputs['editSelectedDate'])->get();
        foreach ($bookingSlots as $bookingSlot) {
            $slotTime = Carbon::parse($bookingSlot->opd_date)->toTimeString();
            $onlyTime = \Str::substr($slotTime, 0, 5);
            $data['bookingSlotArr'][] = $onlyTime;
        }
        if (isset($inputs['editId'])) {
            $editTime = Appointment::whereId($inputs['editId'])->get();
            $editSlotTime = Carbon::parse($editTime[0]->opd_date)->toTimeString();
            $data['onlyTime'] = \Str::substr($editSlotTime, 0, 5);
        }

        return $data;
    }

    /**
     * @return bool
     */
    public function sendAppointmentEmailBeforeOneHour()
    {
        $startTime = Carbon::now()->addHour()->toDateTimeString();
        $endTime = Carbon::now()->addHours(2)->toDateTimeString();
        /** @var Appointment $appointments */
        $appointments = Appointment::with('patient.user', 'doctor.user')
            ->where('opd_date', '>=', $startTime)
            ->where('opd_date', '<=', $endTime)
            ->get();

        foreach ($appointments as $appointment) {
            try {
                $input['patient_email'] = $appointment->patient->user->email;
                $input['patient_name'] = $appointment->patient->user->full_name;
                $input['appointment_date'] = $appointment->opd_date;
                $input['problem'] = $appointment->problem;
                $input['doctor_name'] = $appointment->doctor->user->full_name;
                $input['doctor_email'] = $appointment->doctor->user->email;

                Mail::to($input['patient_email'])
                    ->send(new AppointmentReminderMail('emails.appointment_reminder_patient',
                        'You have an appointment with Dr.'.$input['doctor_name'],
                        $input));
                Mail::to($input['doctor_email'])
                    ->send(new AppointmentReminderMail('emails.appointment_reminder_doctor',
                        'You have an appointment with '.$input['patient_name'],
                        $input));
            } catch (Exception $e) {
                throw new UnprocessableEntityHttpException($e->getMessage());
            }
        }

        return true;
    }

    /**
     * @param  array  $input
     */
    public function createNotification($input)
    {
        try {
            $patient = Patient::with('user')->where('id', $input['patient_id'])->first();
            $doctor = Doctor::with('user')->where('id', $input['doctor_id'])->pluck('user_id', 'id')->first();
            $receptionists = Receptionist::pluck('user_id', 'id')->toArray();
            $userIds = [
                $doctor           => Notification::NOTIFICATION_FOR[Notification::DOCTOR],
                $patient->user_id => Notification::NOTIFICATION_FOR[Notification::PATIENT],
            ];
            foreach ($receptionists as $key => $userId) {
                $userIds[$userId] = Notification::NOTIFICATION_FOR[Notification::RECEPTIONIST];
            }

            $adminUser = User::role('Admin')->first();
            $allUsers = $userIds + [$adminUser->id => Notification::NOTIFICATION_FOR[Notification::ADMIN]];
            $users = getAllNotificationUser($allUsers);

            foreach ($users as $key => $notification) {
                if ($notification == Notification::NOTIFICATION_FOR[Notification::PATIENT]) {
                    $title = $patient->user->full_name.' your appointment has been booked.';
                } else {
                    $title = $patient->user->full_name.' appointment has been booked.';
                }
                addNotification([
                    Notification::NOTIFICATION_TYPE['Appointment'],
                    $key,
                    $notification,
                    $title,
                ]);
            }
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $input
     *
     * @throws Throwable
     *
     * @return bool
     */
    public function createNewAppointment($input): bool
    {
        try {
            DB::beginTransaction();

            $appointmentDepartmentId = $input['department_id'];

            $input['department_id'] = Department::whereName('Patient')->first()->id;
            $input['dob'] = (! empty($input['dob']) || isset($input['dob'])) ? $input['dob'] : null;
            $input['phone'] = (! empty($input['phone']) || isset($input['phone'])) ? $input['phone'] : null;
            $input['password'] = Hash::make($input['password']);
            $input['tenant_id'] = User::where('username', $input['hospital_username'])->first()->tenant_id;
            $userData = Arr::only($input,
                ['first_name', 'last_name', 'gender', 'password', 'email', 'department_id', 'status', 'tenant_id']);

            $user = User::create($userData);
            if (isset($input['email'])) {
                $user->sendEmailVerificationNotification();
            }

            $patient = Patient::create(['user_id' => $user->id, 'tenant_id' => $user->tenant_id]);

            $ownerId = $patient->id;
            $ownerType = Patient::class;
            $user->update(['owner_id' => $ownerId, 'owner_type' => $ownerType]);
            $user->assignRole($input['department_id']);

            $appointment = Appointment::create([
                'patient_id'    => $patient->id,
                'doctor_id'     => $input['doctor_id'],
                'department_id' => $appointmentDepartmentId,
                'opd_date'      => $input['opd_date'],
                'problem'       => $input['problem'],
                'tenant_id'     => $input['tenant_id'],
            ]);


            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return Doctor
     */
    public function getDoctorLists()
    {
        /** @var Doctor $doctors */
        $doctors = Doctor::with('user')->get()->where('user.status', '=', 1)->pluck('user.full_name', 'id');

        return $doctors;
    }

    public function getDoctorList($id)
    {
        /** @var Doctor $doctors */
        $doctors = Doctor::whereId($id)->with('user')->get()->where('user.status', '=', 1)->pluck('user.full_name',
            'id');

        return $doctors;
    }
}
