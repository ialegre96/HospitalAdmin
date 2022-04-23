<?php

namespace App\Queries;

use App\Models\RadiologyTest;
use Illuminate\Database\Query\Builder;

/**
 * Class RadiologyTestDataTable.
 */
class RadiologyTestDataTable
{
    /**
     * @return RadiologyTest|Builder
     */
    public function get()
    {
        /** @var RadiologyTest $query */
        $query = RadiologyTest::with(['radiologycategory', 'chargecategory'])->select('radiology_tests.*');

        return $query;
    }
}
