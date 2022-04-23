<?php

namespace App\Queries;

use App\Models\LabTechnician;
use Illuminate\Database\Query\Builder;

/**
 * Class LabTechnicianDataTable
 */
class LabTechnicianDataTable
{
    /**
     * @param  array  $input
     *
     * @return LabTechnician|Builder
     */
    public function get($input = [])
    {
        /** @var LabTechnician $query */
        $query = LabTechnician::whereHas('user')->with('user.media')->select('lab_technicians.*');

        $query->when(isset($input['status']) && $input['status'] != LabTechnician::STATUS_ALL,
            function (\Illuminate\Database\Eloquent\Builder $q) use ($input) {
                $q->whereHas('user', function ($q) use ($input) {
                    $q->where('status', '=', $input['status']);
                });
            });

        return $query;
    }
}
