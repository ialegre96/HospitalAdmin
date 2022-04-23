<?php

namespace App\Queries;

use App\Models\PatientDiagnosisTest;
use App\Models\User;
use Auth;

/**
 * Class PatientDiagnosisTestDataTable
 */
class PatientDiagnosisTestDataTable
{
    /**
     * @return PatientDiagnosisTest
     */
    public function get()
    {
        /** @var PatientDiagnosisTest $query */
        $query = PatientDiagnosisTest::whereHas('patient.user')->whereHas('doctor.user')->with('patient.user',
            'doctor.user',
            'category')->select('patient_diagnosis_tests.*');

        /** @var User $user */
        $user = Auth::user();
        if ($user->hasRole('Patient')) {
            $query->where('patient_id', $user->owner_id);
        }
        if ($user->hasRole('Doctor')) {
            $query->where('doctor_id', $user->owner_id);
        }

        return $query;
    }
}
