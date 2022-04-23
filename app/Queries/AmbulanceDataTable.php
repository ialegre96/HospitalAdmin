<?php

namespace App\Queries;

use App\Models\Ambulance;
use Illuminate\Database\Query\Builder;

/**
 * Class PaymentDataTable
 */
class AmbulanceDataTable
{
    /**
     * @param  array  $input
     *
     * @return Ambulance|Builder
     */
    public function get($input = [])
    {
        /** @var Ambulance $query */
        $query = Ambulance::select('ambulances.*');

        $query->when(isset($input['is_available']) && $input['is_available'] != Ambulance::STATUS_ALL,
            function (\Illuminate\Database\Eloquent\Builder $q) use ($input) {
                $q->where('is_available', '=', $input['is_available']);
            });

        return $query;
    }
}
