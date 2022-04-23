<?php

namespace App\Queries;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class CategoryDataTable.
 */
class DoctorDataTable
{
    /**
     * @param  array  $input
     *
     * @return Doctor
     */
    public function get(array $input = [])
    {
        /** @var Doctor $query */
        $query = Doctor::whereHas('user')->with('user.media')->select('doctors.*');

        $query->when(isset($input['status']) && $input['status'] != Doctor::STATUS_ALL,
            function (Builder $q) use ($input) {
                $q->whereHas('user', function ($q) use ($input) {
                    $q->where('status', '=', $input['status']);
                });
            });

        return $query;
    }
}
