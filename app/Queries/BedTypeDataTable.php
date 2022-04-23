<?php

namespace App\Queries;

use App\Models\BedType;
use Illuminate\Database\Query\Builder;

/**
 * Class BedTypeDataTable
 */
class BedTypeDataTable
{
    /**
     * @return BedType|Builder
     */
    public function get()
    {
        /** @var BedType $query */
        $query = BedType::query();

        return $query;
    }
}
