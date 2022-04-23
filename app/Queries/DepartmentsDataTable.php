<?php

namespace App\Queries;

use App\Models\Department;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class DepartmentsDataTable
 */
class DepartmentsDataTable
{
    /**
     * @param  array  $input
     * @return \Illuminate\Database\Query\Builder
     */
    public function get($input = [])
    {
        $query = Department::select('departments.*');

        $query->when(isset($input['is_active']) && $input['is_active'] != Department::ACTIVE_ALL,
            function (Builder $q) use ($input) {
                $q->where('is_active', $input['is_active']);
            });

        return $query;
    }
}
