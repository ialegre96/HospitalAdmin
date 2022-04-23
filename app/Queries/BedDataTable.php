<?php

namespace App\Queries;

use App\Models\Bed;
use Illuminate\Database\Query\Builder;

/**
 * Class BedDataTable
 */
class BedDataTable
{
    /**
     * @return Bed|Builder
     */
    public function get($input = [])
    {
        /** @var Bed $query */
        $query = Bed::with('bedType')->select('beds.*');

        $query->when(isset($input['status']) && $input['status'] != Bed::AVAILABLE_ALL,
            function (\Illuminate\Database\Eloquent\Builder $q) use ($input) {
                $q->where('is_available', '=', $input['status']);
            });

        return $query;
    }
}
