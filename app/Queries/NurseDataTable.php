<?php

namespace App\Queries;

use App\Models\Nurse;
use Illuminate\Database\Query\Builder;

/**
 * Class NurseDataTable
 */
class NurseDataTable
{
    /**
     * @param  array  $input
     *
     * @return Nurse|Builder
     */
    public function get($input = [])
    {
        /** @var Nurse $query */
        $query = Nurse::whereHas('user')->with('user.media')->select('nurses.*');

        $query->when(isset($input['status']) && $input['status'] != Nurse::STATUS_ALL,
            function (\Illuminate\Database\Eloquent\Builder $q) use ($input) {
                $q->whereHas('user', function ($q) use ($input) {
                    $q->where('status', '=', $input['status']);
                });
            });

        return $query;
    }
}
