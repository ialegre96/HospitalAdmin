<?php

namespace App\Queries;

use App\Models\IpdPatientDepartment;
use App\Models\LiveConsultation;
use App\Models\OpdPatientDepartment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

/**
 * Class LiveConsultationDataTable
 */
class LiveConsultationDataTable
{
    /**
     * @param  array  $input
     *
     * @return LiveConsultation|Builder
     */
    public function get($input = [])
    {
        /** @var LiveConsultation $query */
        $query = LiveConsultation::whereHas('patient.user')->whereHas('doctor.user')->whereHas('user')->with([
            'patient.user', 'doctor.user', 'user',
        ]);

        $ipdIds = IpdPatientDepartment::pluck('id')->toArray();
        $opdIds = OpdPatientDepartment::pluck('id')->toArray();
        $query->where(function (Builder $q) use ($ipdIds, $opdIds) {
            $q->whereIn('type_number', $ipdIds)->where('type', 1)
                ->orWhereIn('type_number', $opdIds)->where('type', 0);
        });

        $query->when(isset($input['status']) && $input['status'] != LiveConsultation::status,
            function (Builder $q) use ($input) {
                $q->where('status', $input['status']);
            });

        if (getLoggedInUser()->hasRole('Patient')) {
            $query->where('patient_id', getLoggedInUser()->owner_id)->select('live_consultations.*');
        }
        if (getLoggedInUser()->hasRole('Doctor')) {
            $query->where('doctor_id', getLoggedInUser()->owner_id)->select('live_consultations.*');
        }
        $query->select('live_consultations.*');

        return $query;
    }
}
