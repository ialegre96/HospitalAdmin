<?php

namespace App\Queries;

use App\Models\Income;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class IncomeDataTable
 */
class IncomeDataTable
{
    /**
     * @param  array  $input
     *
     * @return Income
     */
    public function get($input = [])
    {
        /** @var Income $query */
        $query = Income::query()->select('incomes.*')->with('media');

        $query->when(! empty($input['income_head']),
            function (Builder $q) use ($input) {
                $q->where('income_head', $input['income_head']);
            });

        return $query;
    }
}
