<?php

namespace App\Queries\Patients;

use App\Models\OpdPatientDepartment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class OpdPatientDepartmentDataTable.
 */
class OpdPatientDepartmentDataTable
{
    /**
     * @param  array  $request
     *
     *
     * @return OpdPatientDepartment[]|Collection
     */
    public function get($request = [])
    {
        /** @var OpdPatientDepartment $query */
        $query = OpdPatientDepartment::with([
            'patient.user', 'doctor.user',
        ])->where('patient_id', getLoggedInUser()->owner_id);
//            ->select('opd_patient_departments.*')
//            ->where('patient_id', getLoggedInUser()->owner_id)
//            ->groupBy('patient_id')
//            ->addSelect('patient_id as pid', DB::raw('count(*) as visits'));
        
        return $query->get();
    }
}
