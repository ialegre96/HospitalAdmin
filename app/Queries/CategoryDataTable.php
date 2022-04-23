<?php

namespace App\Queries;

use App\Models\Category;
use Illuminate\Database\Query\Builder;

/**
 * Class CategoryDataTable.
 */
class CategoryDataTable
{
    /**
     * @param  array  $input
     *
     * @return Category|Builder
     */
    public function get($input = [])
    {
        /** @var Category $query */
        $query = Category::query();

        $query->when(isset($input['is_active']) && $input['is_active'] != Category::STATUS_ALL,
            function (\Illuminate\Database\Eloquent\Builder $q) use ($input) {
                $q->where('is_active', '=', $input['is_active']);
            });

        return $query;
    }
}
