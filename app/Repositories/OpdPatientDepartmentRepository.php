<?php

namespace App\Repositories;

use App\Models\Doctor;
use App\Models\Notification;
use App\Models\OpdPatientDepartment;
use App\Models\Patient;
use App\Models\PatientCase;
use Exception;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class OpdPatientDepartmentRepository
 * @version September 8, 2020, 6:42 am UTC
 */
class OpdPatientDepartmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'patient_id',
        'ipd_number',
        'height',
        'weight',
        'bp',
        'symptoms',
        'notes',
        'admission_date',
        'case_id',
        'is_old_patient',
        'doctor_id',
        'standard_charge',
        'payment_mode',
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
        return OpdPatientDepartment::class;
    }

    /**
     * @return mixed
     */
    public function getAssociatedData()
    {
        $data['patients'] = Patient::with('user')->get()->where('user.status', '=', 1)->pluck('user.full_name',
            'id')->sort();
        $data['doctors'] = Doctor::with('user')->get()->where('user.status', '=', 1)->pluck('user.full_name',
            'id')->sort();
        $data['opdNumber'] = $this->model->generateUniqueOpdNumber();
        $data['paymentMode'] = $this->model::PAYMENT_MODES;

        return $data;
    }

    /**
     * @param  int  $patientId
     *
     * @return Collection
     */
    public function getPatientCases($patientId)
    {
        return PatientCase::where('patient_id', $patientId)->where('status', 1)->pluck('case_id', 'id');
    }

    /**
     * @return Collection
     */
    public function getDoctorsData()
    {
        return Doctor::with('user')->get()->where('user.status', '=', 1)->pluck('user.full_name', 'id');
    }

    /**
     * @return array
     */
    public function getDoctorsList()
    {
        $result = Doctor::with('user')->get()
            ->where('user.status', '=', 1)->pluck('user.full_name', 'id')->toArray();

        $doctors = [];
        foreach ($result as $key => $item) {
            $doctors[] = [
                'key'   => $key,
                'value' => $item,
            ];
        }

        return $doctors;
    }

    /**
     * @param  array  $input
     *
     * @return bool
     */
    public function store($input)
    {
        try {
            $input['is_old_patient'] = isset($input['is_old_patient']) ? true : false;
            OpdPatientDepartment::create($input);
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }

        return true;
    }

    /**
     * @param  array  $input
     * @param  OpdPatientDepartment  $opdPatientDepartment
     *
     * @return bool
     */
    public function updateOpdPatientDepartment($input, $opdPatientDepartment)
    {
        try {
            $input['is_old_patient'] = isset($input['is_old_patient']) ? true : false;
            $opdPatientDepartment->update($input);
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
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
            $doctor = Doctor::with('user')->where('id', $input['doctor_id'])->first()->user->fullname;

            if (isset($input['revisit'])) {
                $title = $patient->user->full_name.' you are visited doctor '.$doctor.'.';
            } else {
                $title = $patient->user->full_name.' your OPD record has been created.';
            }
            addNotification([
                Notification::NOTIFICATION_TYPE['OPD Patient'],
                $patient->user_id,
                Notification::NOTIFICATION_FOR[Notification::PATIENT],
                $title,
            ]);
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
