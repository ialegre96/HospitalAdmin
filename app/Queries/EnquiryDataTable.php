<?php

namespace App\Queries;

use App\Models\Enquiry;
use Illuminate\Database\Query\Builder;

/**
 * Class EnquiryDataTable.
 */
class EnquiryDataTable
{
    /**
     * @param  array  $input
     *
     * @return Enquiry|Builder
     */
    public function get($input = [])
    {
        /** @var Enquiry $query */
        $query = Enquiry::with('user')->select('enquiries.*');

        $query->when(isset($input['status']) && $input['status'] != Enquiry::ALL,
            function (\Illuminate\Database\Eloquent\Builder $q) use ($input) {
                $q->where('status', '=', $input['status']);
            });

        return $query;
    }
}
