<?php

namespace App\Queries;

use App\Models\Item;
use Illuminate\Database\Query\Builder;

/**
 * Class ItemDataTable
 */
class ItemDataTable
{
    /**
     * @return Item|Builder
     */
    public function get()
    {
        /** @var Item $query */
        $query = Item::with(['itemcategory'])->select('items.*');

        return $query;
    }
}
