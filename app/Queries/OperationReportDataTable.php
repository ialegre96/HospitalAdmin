<?php

namespace App\Queries;

use App\Models\OperationReport;
use App\Models\User;
use Auth;
use Illuminate\Database\Query\Builder;

/**
 * Class OperationReportTable.
 */
class OperationReportDataTable
{
    /**
     * @return OperationReport|Builder
     */
    public function get()
    {
        /** @var OperationReport $query */
        $query = OperationReport::whereHas('patient.user')->whereHas('doctor.user')->with('patient.user', 'doctor.user',
            'caseFromOperationReport')
            ->select('operation_reports.*');

        /** @var User $user */
        $user = Auth::user();
        if ($user->hasRole('Doctor')) {
            $query->where('doctor_id', $user->owner_id);
        }

        return $query;
    }
}
