<?php

namespace App\Queries;

use App\Models\Module;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ModuleDataTable.
 */
class ModuleDataTable
{
    /**
     * @param  array  $input
     *
     * @return Module|Builder
     */
    public function get($input = [])
    {
        /** @var Module $query */
        $query = Module::Query();

        $query->when(isset($input['status']) && $input['status'] != Module::STATUS_ALL,
            function (Builder $query) use ($input) {
                $query->where('is_active', '=', $input['status']);
            });

        return $query;
    }
}
