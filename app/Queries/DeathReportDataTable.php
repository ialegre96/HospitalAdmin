<?php

namespace App\Queries;

use App\Models\DeathReport;
use App\Models\User;
use Auth;
use Illuminate\Database\Query\Builder;

/**
 * Class DeathReportDataTable
 */
class DeathReportDataTable
{
    /**
     * @return DeathReport|Builder
     */
    public function get()
    {
        /** @var DeathReport $query */
        $query = DeathReport::whereHas('patient.user')->whereHas('doctor.user')->with('patient.user', 'doctor.user',
            'caseFromDeathReport')
            ->select('death_reports.*');

        /** @var User $user */
        $user = Auth::user();
        if ($user->hasRole('Doctor')) {
            $query->where('doctor_id', $user->owner_id);
        }

        return $query;
    }
}
