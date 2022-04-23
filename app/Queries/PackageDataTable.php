<?php

namespace App\Queries;

use App\Models\Package;
use Illuminate\Database\Query\Builder;

/**
 * Class PackageDataTable.
 */
class PackageDataTable
{
    /**
     * @return Package|Builder
     */
    public function get()
    {
        /** @var Package $query */
        $query = Package::select('packages.*');

        return $query;
    }
}
