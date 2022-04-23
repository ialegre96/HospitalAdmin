<?php

namespace App\Queries;

use App\Models\RadiologyCategory;
use Illuminate\Database\Query\Builder;

/**
 * Class RadiologyCategoryDataTable.
 */
class RadiologyCategoryDataTable
{
    /**
     * @return RadiologyCategory|Builder
     */
    public function get()
    {
        /** @var RadiologyCategory $query */
        $query = RadiologyCategory::select('radiology_categories.*');

        return $query;
    }
}
