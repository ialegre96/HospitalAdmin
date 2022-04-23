<?php

namespace App\Queries;

use App\Models\Visitor;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class VisitorDataTable.
 */
class VisitorDataTable
{
    /**
     * @param  array  $input
     *
     * @return Visitor|Builder
     */
    public function get($input = [])
    {
        /** @var visitor $query */
        $query = Visitor::query()->with('media')->select('visitors.*');

        $query->when(! empty($input['purpose']),
            function (Builder $q) use ($input) {
                $q->where('purpose', $input['purpose']);
            });

        return $query;
    }
}
