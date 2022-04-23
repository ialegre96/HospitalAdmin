<?php

namespace App\Queries;

use App\Models\Brand;
use Illuminate\Support\Collection;

/**
 * Class DepartmentsDataTable
 */
class BrandDataTable
{
    /**
     * @return Collection
     */
    public function get()
    {
        $query = Brand::query();

        return $query;
    }
}
