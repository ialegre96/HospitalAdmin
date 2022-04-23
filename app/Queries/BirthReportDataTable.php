<?php

namespace App\Queries;

use App\Models\BirthReport;
use App\Models\User;
use Auth;
use Illuminate\Database\Query\Builder;

/**
 * Class BirthReportDataTable
 */
class BirthReportDataTable
{
    /**
     * @return BirthReport|Builder
     */
    public function get()
    {
        /** @var BirthReport $query */
        $query = BirthReport::whereHas('patient.user')->whereHas('doctor.user')->with('patient.user', 'doctor.user',
            'caseFromBirthReport')
            ->select('birth_reports.*');

        /** @var User $user */
        $user = Auth::user();
        if ($user->hasRole('Doctor')) {
            $query->where('doctor_id', $user->owner_id);
        }

        return $query;
    }
}
