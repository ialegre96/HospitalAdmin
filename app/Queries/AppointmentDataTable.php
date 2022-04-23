<?php

namespace App\Queries;

use App\Models\Appointment;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class AppointmentDataTable
 */
class AppointmentDataTable
{
    /**
     * @param  array  $input
     *
     * @return Appointment
     */
    public function get($input = [])
    {
        /** @var User $authUser */
        $authUser = Auth::user();
        /** @var Appointment $query */
        $query = Appointment::whereHas('patient.user')->whereHas('doctor.user')->with([
            'patient.user', 'doctor.department', 'doctor.user',
        ])
            ->when($input['is_completed'] == Appointment::STATUS_PENDING || $input['is_completed'] == Appointment::STATUS_COMPLETED,
                function (Builder $q) use ($input) {
                    $q->where('is_completed', $input['is_completed']);
                })
            ->when(isset($input['start_date']) && isset($input['end_date']),
                function (Builder $q) use ($input) {
                    $q->whereBetween('opd_date', [$input['start_date'], $input['end_date']]);
                })
            ->select('appointments.*');
        if ($authUser->hasRole('Patient')) {
            $query->whereHas('patient', function (Builder $query) use ($authUser) {
                $query->where('user_id', '=', $authUser->id);
            });
        }

        if ($authUser->hasRole('Doctor')) {
            $query->whereHas('doctor', function (Builder $query) use ($authUser) {
                $query->where('doctor_id', '=', $authUser->owner_id);
            });
        }

        return $query;
    }
}
