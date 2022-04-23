<?php

namespace App\Repositories;

use App\Models\IpdPatientDepartment;
use App\Models\IpdPrescription;
use App\Models\IpdPrescriptionItem;
use App\Models\Medicine;
use App\Models\Notification;
use Arr;
use Exception;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class IpdPrescriptionRepository
 * @version September 10, 2020, 11:42 am UTC
 */
class IpdPrescriptionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ipd_patient_department_id',
        'created_at',
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
        return IpdPrescription::class;
    }

    /**
     * @param  int  $medicineCategoryId
     *
     * @return Collection
     */
    public function getMedicines($medicineCategoryId)
    {
        return Medicine::where('category_id', $medicineCategoryId)->pluck('name', 'id');
    }

    /**
     * @param  array  $input
     *
     * @return bool
     */
    public function store($input)
    {
        try {
            $ipdPrescriptionArr = Arr::only($input, $this->model->getFillable());
            $ipdPrescription = $this->model->create($ipdPrescriptionArr);

            foreach ($input['category_id'] as $key => $value) {
                $ipdPrescriptionItem = [
                    'ipd_prescription_id' => $ipdPrescription->id,
                    'category_id'         => $input['category_id'][$key],
                    'medicine_id'         => $input['medicine_id'][$key],
                    'dosage'              => $input['dosage'][$key],
                    'instruction'         => $input['instruction'][$key],
                ];
                IpdPrescriptionItem::create($ipdPrescriptionItem);
            }
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }

        return true;
    }

    /**
     * @param  IpdPrescription  $ipdPrescription
     *
     * @return mixed
     */
    public function getIpdPrescriptionData($ipdPrescription)
    {
        $data['ipdPrescription'] = $ipdPrescription->toArray();
        $data['ipdPrescriptionItems'] = $ipdPrescription->ipdPrescriptionItems->toArray();
        $data['medicines'] = Medicine::pluck('name', 'id');

        return $data;
    }

    /**
     * @param  array  $input
     * @param  IpdPrescription  $ipdPrescription
     *
     * @return bool
     */
    public function updateIpdPrescriptionItems($input, $ipdPrescription)
    {
        try {
            $ipdPrescriptionArr = Arr::only($input, $this->model->getFillable());
            $ipdPrescription->update($ipdPrescriptionArr);
            $ipdPrescription->ipdPrescriptionItems()->delete();

            foreach ($input['category_id'] as $key => $value) {
                $ipdPrescriptionItem = [
                    'ipd_prescription_id' => $ipdPrescription->id,
                    'category_id'         => $input['category_id'][$key],
                    'medicine_id'         => $input['medicine_id'][$key],
                    'dosage'              => $input['dosage'][$key],
                    'instruction'         => $input['instruction'][$key],
                ];
                IpdPrescriptionItem::create($ipdPrescriptionItem);
            }
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
            $patient = IpdPatientDepartment::with('patient.user')->where('id',
                $input['ipd_patient_department_id'])->first();
            $doctor = IpdPatientDepartment::with('doctor.user')->where('id',
                $input['ipd_patient_department_id'])->first();
            $userIds = [
                $doctor->doctor->user_id   => Notification::NOTIFICATION_FOR[Notification::DOCTOR],
                $patient->patient->user_id => Notification::NOTIFICATION_FOR[Notification::PATIENT],
            ];

            foreach ($userIds as $key => $notification) {
                if ($notification == Notification::NOTIFICATION_FOR[Notification::PATIENT]) {
                    $title = $patient->patient->user->full_name.' your IPD prescription has been created.';
                } else {
                    $title = $patient->patient->user->full_name.' IPD prescription has been created.';
                }
                addNotification([
                    Notification::NOTIFICATION_TYPE['IPD Prescription'],
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
