<?php

namespace App\Queries;

use App\Models\Patient;
use Illuminate\Database\Query\Builder;

/**
 * Class CategoryDataTable.
 */
class PatientDataTable
{
    /**
     * @param  array  $input
     *
     * @return Patient|Builder
     */
    public function get($input = [])
    {
        /** @var Patient $query */
        $query = Patient::whereHas('user')->with('user.media')->select('patients.*');

        $query->when(isset($input['status']) && $input['status'] != Patient::STATUS_ALL,
            function (\Illuminate\Database\Eloquent\Builder $q) use ($input) {
                $q->whereHas('user', function ($q) use ($input) {
                    $q->where('status', '=', $input['status']);
                });
            });

        return $query;
    }
}
