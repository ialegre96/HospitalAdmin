<?php

namespace App\Queries;

use App\Models\CallLog;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class CallLogDataTable.
 */
class CallLogDataTable
{
    /**
     * @param  array  $input
     *
     * @return CallLog|Builder
     */
    public function get($input = [])
    {
        /** @var CallLog $query */
        $query = CallLog::query()->select('call_logs.*');

        $query->when(! empty($input['call_type']),
            function (Builder $q) use ($input) {
                $q->where('call_type', $input['call_type']);
            });

        return $query;
    }
}
