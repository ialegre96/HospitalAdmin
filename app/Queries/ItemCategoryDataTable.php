<?php

namespace App\Queries;

use App\Models\ItemCategory;
use Illuminate\Database\Query\Builder;

/**
 * Class ItemCategoryDataTable
 */
class ItemCategoryDataTable
{
    /**
     * @return ItemCategory|Builder
     */
    public function get()
    {
        /** @var ItemCategory $query */
        $query = ItemCategory::query();

        return $query;
    }
}
