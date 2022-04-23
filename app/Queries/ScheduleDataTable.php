<?php

namespace App\Queries;

use App\Models\Schedule;
use App\Models\User;
use Auth;
use Illuminate\Database\Query\Builder;

/**
 * Class ScheduleDataTable
 */
class ScheduleDataTable
{
    /**
     * @param  array  $input
     *
     * @return Schedule|Builder
     */
    public function get($input = [])
    {
        /** @var Schedule $query */
        $query = Schedule::whereHas('doctor.user')->with('doctor.user')->select('schedules.*');

        /** @var User $user */
        $user = Auth::user();
        if ($user->hasRole('Doctor')) {
            $query->where('doctor_id', $user->owner_id);
        }

        return $query;
    }
}
