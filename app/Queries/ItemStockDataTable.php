<?php

namespace App\Queries;

use App\Models\ItemStock;
use Illuminate\Database\Query\Builder;

/**
 * Class ItemStockDataTable
 */
class ItemStockDataTable
{
    /**
     * @return ItemStock|Builder
     */
    public function get()
    {
        /** @var ItemStock $query */
        $query = ItemStock::with(['item', 'item.itemcategory'])->select('item_stocks.*');

        return $query;
    }
}
