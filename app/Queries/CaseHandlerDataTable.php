<?php

namespace App\Queries;

use App\Models\CaseHandler;
use Illuminate\Database\Query\Builder;

/**
 * Class CaseHandlerDataTable
 */
class CaseHandlerDataTable
{
    /**
     * @param  array  $input
     *
     * @return CaseHandler|Builder
     */
    public function get($input = [])
    {
        /** @var CaseHandler $query */
        $query = CaseHandler::whereHas('user')->with('user.media')->select('case_handlers.*');

        $query->when(isset($input['status']) && $input['status'] != CaseHandler::STATUS_ALL,
            function (\Illuminate\Database\Eloquent\Builder $q) use ($input) {
                $q->whereHas('user', function ($q) use ($input) {
                    $q->where('status', '=', $input['status']);
                });
            });

        return $query;
    }
}
