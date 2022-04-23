<?php

namespace App\Queries;

use App\Models\OpdPatientDepartment;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

/**
 * Class OpdPatientDepartmentDataTable.
 */
class OpdPatientDepartmentDataTable
{
    /**
     * @return OpdPatientDepartment|Builder
     */
    public function get($request = [])
    {
        /** @var OpdPatientDepartment $query */
        $query = OpdPatientDepartment::whereHas('patient.user')->whereHas('doctor.user')
            ->with(['patient.user', 'doctor.user'])
            ->select('opd_patient_departments.*')
            ->when(isset($request['patient_id']), function ($query) use ($request) {
                return $query->wherePatientId($request['patient_id']);
            })
            ->when(! isset($request['patient_id']), function ($query) {
                return $query->groupBy('patient_id')->addSelect('patient_id as pid', DB::raw('count(*) as visits'));
            });

        return $query;
    }
}
