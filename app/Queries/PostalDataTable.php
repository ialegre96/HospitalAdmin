<?php

namespace App\Queries;

use App\Models\Postal;
use Illuminate\Database\Query\Builder;
use Route;

/**
 * Class PostalDataTable.
 */
class PostalDataTable
{
    /**
     * @return Postal|Builder
     */
    public function get()
    {
        /** @var Postal $query */
        $query = Postal::query()->select('postals.*')->with('media');
        if (Route::current()->getName() == 'receives.index') {
            $query = $query->where('type', '=', Postal::POSTAL_RECEIVE);
        }

        if (Route::current()->getName() == 'dispatches.index') {
            $query = $query->where('type', '=', Postal::POSTAL_DISPATCH);
        }

        return $query;
    }
}
