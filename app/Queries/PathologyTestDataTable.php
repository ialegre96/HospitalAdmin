<?php

namespace App\Queries;

use App\Models\PathologyTest;
use Illuminate\Database\Query\Builder;

/**
 * Class PathologyTestDataTable.
 */
class PathologyTestDataTable
{
    /**
     * @return PathologyTest|Builder
     */
    public function get()
    {
        /** @var PathologyTest $query */
        $query = PathologyTest::with(['pathologycategory', 'chargecategory'])->select('pathology_tests.*');

        return $query;
    }
}
