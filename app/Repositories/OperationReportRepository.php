<?php

namespace App\Repositories;

use App\Models\Doctor;
use App\Models\OperationReport;
use App\Models\PatientCase;
use Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class OperationReportRepository
 * @version February 18, 2020, 6:02 am UTC
 */
class OperationReportRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'patient_name',
        'case_number',
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
        return OperationReport::class;
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
     * @return array
     */
    public function getCases()
    {
        $user = Auth::user();
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
     * @param  array  $input
     *
     * @return bool
     */
    public function store($input)
    {
        try {
            $caseId = $input['case_id'];
            $input['date'] = Carbon::parse($input['date'])->format('Y-m-d H:i:s');
            $patientId = PatientCase::whereCaseId($caseId)->first()->patient_id;
            $input['patient_id'] = $patientId;
            $operationReport = OperationReport::create($input);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     * @param  OperationReport  $operationReport
     *
     * @return bool|Builder|Builder[]|Collection|Model
     */
    public function update($input, $operationReport)
    {
        try {
            $caseId = $input['case_id'];
            $input['date'] = Carbon::parse($input['date'])->format('Y-m-d H:i:s');
            $patientId = PatientCase::whereCaseId($caseId)->first()->patient_id;
            $input['patient_id'] = $patientId;
            $operationReport->update($input);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
