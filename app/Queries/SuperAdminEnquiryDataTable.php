<?php

namespace App\Queries;

use App\Models\SuperAdminEnquiry;
use Illuminate\Database\Query\Builder;

/**
 * Class SuperAdminEnquiryDataTable.
 */
class SuperAdminEnquiryDataTable
{
    /**
     * @param  array  $input
     *
     * @return SuperAdminEnquiry|Builder
     */
    public function get($input = [])
    {
        /** @var SuperAdminEnquiry $query */
        $query = SuperAdminEnquiry::select('super_admin_enquiries.*');

        $query->when(isset($input['status']) && $input['status'] != SuperAdminEnquiry::ALL,
            function (\Illuminate\Database\Eloquent\Builder $q) use ($input) {
                $q->where('status', '=', $input['status']);
            });

        return $query;
    }
}
