<?php

namespace App\Repositories;

use App\Models\BirthReport;
use App\Models\Doctor;
use App\Models\PatientCase;
use Carbon\Carbon;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class BirthReportRepository
 * @version February 18, 2020, 9:47 am UTC
 */
class BirthReportRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'patient_id',
        'case_id',
        'doctor_id',
        'date',
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
        return BirthReport::class;
    }

    /**
     * @return array
     */
    public function getCases()
    {
        $user = \Auth::user();
        if ($user->hasRole('Doctor')) {
            $cases = PatientCase::with('patient.user')->where('doctor_id', '=', $user->owner_id)->get()->where('status',
                '=', 1);
        } else {
            $cases = PatientCase::with('patient.user')->get()->where('status', '=', 1)->sort();
        }

        $result = [];
        foreach ($cases as $case) {
            $result[$case->case_id] = $case->case_id.'  '.$case->patient->user->full_name;
        }

        return $result;
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
     * @return bool
     */
    public function store($input)
    {
        try {
            $caseId = $input['case_id'];
            $patientId = PatientCase::whereCaseId($caseId)->first()->patient_id;
            $input['patient_id'] = $patientId;
            $birthReport = BirthReport::create($input);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     * @param  BirthReport  $birthReport
     *
     * @return bool
     */
    public function update($input, $birthReport)
    {
        try {
            $caseId = $input['case_id'];
            $input['date'] = Carbon::parse($input['date'])->format('Y-m-d H:i:s');
            $patientId = PatientCase::whereCaseId($caseId)->first()->patient_id;
            $input['patient_id'] = $patientId;
            $birthReport->update($input);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
