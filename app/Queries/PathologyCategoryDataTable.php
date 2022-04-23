<?php

namespace App\Queries;

use App\Models\PathologyCategory;
use Illuminate\Database\Query\Builder;

/**
 * Class PathologyCategoryDataTable.
 */
class PathologyCategoryDataTable
{
    /**
     * @return PathologyCategory|Builder
     */
    public function get()
    {
        /** @var PathologyCategory $query */
        $query = PathologyCategory::select('pathology_categories.*');

        return $query;
    }
}
