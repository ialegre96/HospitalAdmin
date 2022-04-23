<?php

namespace App\Repositories;

use App\Models\Notification;
use App\Models\OpdDiagnosis;
use App\Models\OpdPatientDepartment;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class OpdDiagnosisRepository
 * @version September 8, 2020, 11:46 am UTC
 */
class OpdDiagnosisRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'opd_patient_department_id',
        'report_type',
        'report_date',
        'description',
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
        return OpdDiagnosis::class;
    }

    /**
     * @param  array  $input
     */
    public function store($input)
    {
        try {
            /** @var OpdDiagnosis $opdDiagnosis */
            $opdDiagnosis = $this->create($input);
            if (isset($input['file']) && ! empty($input['file'])) {
                $opdDiagnosis->addMedia($input['file'])->toMediaCollection(OpdDiagnosis::OPD_DIAGNOSIS_PATH,
                    config('app.media_disc'));
            }
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     * @param  int  $opdDiagnosisId
     */
    public function updateOpdDiagnosis($input, $opdDiagnosisId)
    {
        try {
            /** @var OpdDiagnosis $opdDiagnosis */
            $opdDiagnosis = $this->update($input, $opdDiagnosisId);
            if (isset($input['file']) && !empty($input['file'])) {
                $opdDiagnosis->clearMediaCollection(OpdDiagnosis::OPD_DIAGNOSIS_PATH);
                $opdDiagnosis->addMedia($input['file'])->toMediaCollection(OpdDiagnosis::OPD_DIAGNOSIS_PATH,
                    config('app.media_disc'));
            }
            if ($input['avatar_remove'] == 1 && isset($input['avatar_remove']) && !empty($input['avatar_remove'])) {
                removeFile($opdDiagnosis, OpdDiagnosis::OPD_DIAGNOSIS_PATH);
            }
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  int  $opdDiagnosisId
     */
    public function deleteOpdDiagnosis($opdDiagnosisId)
    {
        try {
            /** @var OpdDiagnosis $opdDiagnosis */
            $opdDiagnosis = $this->find($opdDiagnosisId);
            $opdDiagnosis->clearMediaCollection(OpdDiagnosis::OPD_DIAGNOSIS_PATH);
            $this->delete($opdDiagnosisId);
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     */
    public function createNotification($input)
    {
        try {
            $patient = OpdPatientDepartment::with('patient.user')->where('id',
                $input['opd_patient_department_id'])->first();
            addNotification([
                Notification::NOTIFICATION_TYPE['OPD Diagnosis'],
                $patient->patient->user_id,
                Notification::NOTIFICATION_FOR[Notification::PATIENT],
                $patient->patient->user->full_name.' your OPD diagnosis has been created.',
            ]);
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
