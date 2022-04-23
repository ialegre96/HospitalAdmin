<?php

namespace App\Queries;

use App\Models\IssuedItem;
use Illuminate\Database\Query\Builder;

/**
 * Class IssuedItemDataTable
 */
class IssuedItemDataTable
{
    /**
     * @param  array  $input
     *
     * @return IssuedItem|Builder
     */
    public function get($input = [])
    {
        /** @var IssuedItem $query */
        $query = IssuedItem::whereHas('user')->with(['item', 'item.itemcategory', 'user'])->select('issued_items.*');

        $query->when(isset($input['status']) && $input['status'] != IssuedItem::STATUS_ALL,
            function (\Illuminate\Database\Eloquent\Builder $q) use ($input) {
                $q->where('status', $input['status']);
            });

        return $query;
    }
}
