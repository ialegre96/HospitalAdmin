<?php

namespace App\Queries;

use App\Models\ChargeCategory;
use Illuminate\Database\Query\Builder;

/**
 * Class ChargeCategoryDataTable
 */
class ChargeCategoryDataTable
{
    /**
     * @return ChargeCategory|Builder
     */
    public function get()
    {
        /** @var ChargeCategory $query */
        $query = ChargeCategory::query()->select('charge_categories.*');

        return $query;
    }
}
