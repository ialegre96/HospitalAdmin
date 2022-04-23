<?php

namespace App\Queries;

use App\Models\BloodBank;
use Illuminate\Database\Query\Builder;

/**
 * Class CategoryDataTable.
 */
class BloodBankDataTable
{
    /**
     * @return BloodBank|Builder
     */
    public function get()
    {
        /** @var BloodBank $query */
        $query = BloodBank::query();

        return $query;
    }
}
