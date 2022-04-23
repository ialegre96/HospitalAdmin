<?php

namespace App\Repositories;

use App\Models\CaseHandler;
use App\Models\Doctor;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\PatientCase;
use App\Models\Receptionist;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class PatientCaseRepository
 * @version February 19, 2020, 4:48 am UTC
 */
class PatientCaseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'case_id',
        'patient_id',
        'phone',
        'doctor_id',
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
        return PatientCase::class;
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
     * @return Doctor
     */
    public function getDoctors()
    {
        /** @var Doctor $doctors */
        $doctors = Doctor::with('user')->get()->where('user.status', '=', 1)->pluck('user.full_name', 'id')->sort();

        return $doctors;
    }

    /**
     * @param  array  $input
     *
     * @return bool|UnprocessableEntityHttpException
     */
    public function store($input)
    {
        try {
            $input['case_id'] = mb_strtoupper(PatientCase::generateUniqueCaseId());
            $patientCase = PatientCase::create($input);

            return true;
        } catch (Exception $e) {
            return new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     */
    public function createNotification($input)
    {
        try {
            $patient = Patient::with('user')->where('id', $input['patient_id'])->first();
            $doctor = Doctor::with('user')->where('id', $input['doctor_id'])->first();
            $receptionists = Receptionist::pluck('user_id', 'id')->toArray();
            $caseHandeler = CaseHandler::pluck('user_id', 'id')->toArray();
            $userIds = [
                $doctor->user_id  => Notification::NOTIFICATION_FOR[Notification::DOCTOR],
                $patient->user_id => Notification::NOTIFICATION_FOR[Notification::PATIENT],
            ];

            foreach ($receptionists as $key => $userId) {
                $userIds[$userId] = Notification::NOTIFICATION_FOR[Notification::RECEPTIONIST];
            }

            foreach ($caseHandeler as $key => $userId) {
                $userIds[$userId] = Notification::NOTIFICATION_FOR[Notification::CASE_HANDLER];
            }
            $users = getAllNotificationUser($userIds);

            foreach ($users as $key => $notification) {
                if ($notification == Notification::NOTIFICATION_FOR[Notification::PATIENT]) {
                    $title = $patient->user->full_name.' your case has been created.';
                } else {
                    $title = $patient->user->full_name.' case has been created.';
                }
                addNotification([
                    Notification::NOTIFICATION_TYPE['Cases'],
                    $key,
                    $notification,
                    $title,
                ]);
            }
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
