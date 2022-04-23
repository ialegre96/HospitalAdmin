<?php

namespace App\Queries;

use App\Models\Accountant;
use App\Models\PatientAdmission;
use App\Models\User;
use Auth;
use Illuminate\Database\Query\Builder;

/**
 * Class AccountantData
 */
class PatientAdmissionDataTable
{
    /**
     * @param  array  $input
     *
     * @return Accountant|Builder
     */
    public function get($input = [])
    {
        /** @var Accountant $query */
        $query = PatientAdmission::whereHas('patient.user')->whereHas('doctor.user')->with('patient.user',
            'doctor.user', 'package', 'insurance')
            ->select('patient_admissions.*');

        $query->when(isset($input['status']) && $input['status'] != PatientAdmission::STATUS_ALL,
            function (\Illuminate\Database\Eloquent\Builder $q) use ($input) {
                $q->where('patient_admissions.status', '=', $input['status']);
            });

        /** @var User $user */
        $user = Auth::user();
        if ($user->hasRole('Patient')) {
            $query->where('patient_id', $user->owner_id);
        } elseif ($user->hasRole('Doctor')) {
            $query->where('doctor_id', $user->owner_id);
        }

        return $query;
    }
}
