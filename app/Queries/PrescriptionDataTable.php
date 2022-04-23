<?php

namespace App\Queries;

use App\Models\Prescription;
use App\Models\User;
use Auth;
use Illuminate\Database\Query\Builder;

/**
 * Class PrescriptionDataTable.
 */
class PrescriptionDataTable
{
    /**
     * @param  array  $input
     *
     * @return Prescription|Builder
     */
    public function get($input = [])
    {
        /** @var User $user */
        $user = Auth::user();

        /** @var Prescription $query */
        $query = Prescription::whereHas('patient.user')->whereHas('doctor.user')->with('patient.user',
            'doctor.user')->select('prescriptions.*');

        $query->when(isset($input['status']) && $input['status'] != Prescription::STATUS_ALL,
            function (\Illuminate\Database\Eloquent\Builder $q) use ($input) {
                $q->where('prescriptions.status', '=', $input['status']);
            });

        if ($user->hasRole('Doctor')) {
            $query->where('doctor_id', $user->owner_id);
        }
        if ($user->hasRole('Patient')) {
            $query->where('patient_id', $user->owner_id);
        }

        return $query;
    }
}
