<?php

namespace App\Queries;

use App\Models\IpdDiagnosis;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class IpdDiagnosisDataTable
 */
class IpdDiagnosisDataTable
{
    /**
     * @param  int  $ipdPatientDepartmentId
     *
     * @return Builder
     */
    public function get($ipdPatientDepartmentId)
    {
        return IpdDiagnosis::whereIpdPatientDepartmentId($ipdPatientDepartmentId)->select('ipd_diagnoses.*');
    }
}
