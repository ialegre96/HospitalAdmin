<?php

namespace App\Queries;

use App\Models\Accountant;
use App\Models\CaseHandler;
use App\Models\Doctor;
use App\Models\EmployeePayroll;
use App\Models\LabTechnician;
use App\Models\Nurse;
use App\Models\Pharmacist;
use App\Models\Receptionist;
use App\Models\User;
use Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Query\Builder;
use Route;

/**
 * Class EmployeePayrollDataTable.
 */
class EmployeePayrollDataTable
{
    const payrollUsers = [
        Doctor::class, Nurse::class, LabTechnician::class, Receptionist::class, Pharmacist::class, Accountant::class,
        CaseHandler::class,
    ];

    /**
     * @param  array  $input
     *
     * @return EmployeePayroll|\Illuminate\Database\Eloquent\Builder[]|Collection|Builder
     */
    public function get($input = [])
    {
        /** @var EmployeePayroll $query */
        $query = EmployeePayroll::whereHasMorph(
            'owner', [
            Nurse::class,
            Doctor::class,
            LabTechnician::class,
            Receptionist::class,
            Pharmacist::class,
            Accountant::class,
            CaseHandler::class,
        ], function ($q, $type) {
            if (in_array($type, self::payrollUsers)) {
                $q->whereHas('user', function (\Illuminate\Database\Eloquent\Builder $qr) {
                    return $qr;
                });
            }
        })->with('owner.user')->select('employee_payrolls.*');

        $query->when(isset($input['status']) && $input['status'] != EmployeePayroll::STATUS_ALL,
            function (\Illuminate\Database\Eloquent\Builder $q) use ($input) {
                $q->where('status', '=', $input['status']);
            });

        /** @var User $user */
        $user = Auth::user();
        $route = Route::current()->getName();
        if (! ($route == 'payroll' && ! $user->hasRole(['Admin']))) {
            return $query;
        }
        $query->where('owner_id', $user->owner_id);
        $query->where('owner_type', $user->owner_type);

        return $query;
    }
}
