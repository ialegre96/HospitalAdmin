<?php

namespace App\Queries;

use App\Models\Insurance;
use Illuminate\Database\Query\Builder;

/**
 * Class InsuranceDataTable
 */
class InsuranceDataTable
{
    /**
     * @param  array  $input
     *
     * @return Insurance|Builder
     */
    public function get($input = [])
    {
        /** @var Insurance $query */
        $query = Insurance::Query();

        $query->when(isset($input['status']) && $input['status'] != Insurance::STATUS_ALL,
            function (\Illuminate\Database\Eloquent\Builder $q) use ($input) {
                $q->where('status', '=', $input['status']);
            });

        return $query;
    }
}
