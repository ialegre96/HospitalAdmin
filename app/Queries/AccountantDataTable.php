<?php

namespace App\Queries;

use App\Models\Accountant;
use Illuminate\Database\Query\Builder;

/**
 * Class AccountantData
 */
class AccountantDataTable
{
    /**
     * @param  array  $input
     *
     * @return Accountant|Builder
     */
    public function get($input = [])
    {
        /** @var Accountant $query */
        $query = Accountant::whereHas('user')->with('user')->select('accountants.*');

        $query->when(isset($input['status']) && $input['status'] != Accountant::STATUS_ALL,
            function (\Illuminate\Database\Eloquent\Builder $q) use ($input) {
                $q->whereHas('user', function ($q) use ($input) {
                    $q->where('status', '=', $input['status']);
                });
            });

        return $query;
    }
}
