<?php

namespace App\Queries;

use App\Models\PatientCase;
use App\Models\User;
use Auth;
use Illuminate\Database\Query\Builder;

/**
 * Class PatientCaseDataTable
 */
class PatientCaseDataTable
{
    /**
     * @param  array  $input
     *
     * @return PatientCase|Builder
     */
    public function get($input = [])
    {
        /** @var PatientCase $query */
        $query = PatientCase::whereHas('patient.user')->whereHas('doctor.user')->with('patient.user',
            'doctor.user')->select('patient_cases.*');

        $query->when(isset($input['status']) && $input['status'] != PatientCase::STATUS_ALL,
            function (\Illuminate\Database\Eloquent\Builder $q) use ($input) {
                $q->where('patient_cases.status', '=', $input['status']);
            });

        /** @var User $user */
        $user = Auth::user();
        if ($user->hasRole('Doctor')) {
            $query->where('doctor_id', $user->owner_id);
        }

        if ($user->hasRole('Patient')) {
            $query->where('patient_id', $user->owner_id);
        }

        return $query;
    }
}
