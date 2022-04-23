<?php

namespace App\Queries\Patients;

use App\Models\IpdPatientDepartment;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class IpdPatientDepartmentDataTable.
 */
class IpdPatientDepartmentDataTable
{
    /**
     * @return IpdPatientDepartment|Builder
     */
    public function get()
    {
        /** @var IpdPatientDepartment $query */
        $query = IpdPatientDepartment::with(['patient.user', 'doctor.user', 'bed'])
            ->where('patient_id', getLoggedInUser()->owner_id)->select('ipd_patient_departments.*');

        return $query;
    }
}
