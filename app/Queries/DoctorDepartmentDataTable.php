<?php

namespace App\Queries;

use App\Models\DoctorDepartment;

/**
 * Class DoctorDepartmentDataTable.
 */
class DoctorDepartmentDataTable
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function get()
    {
        /** @var DoctorDepartment $query */
        return DoctorDepartment::query();
    }
}
