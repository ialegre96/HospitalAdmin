<?php

namespace App\Queries;

use App\Models\Invoice;
use App\Models\User;
use Auth;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class BillDataTable
 */
class InvoiceDataTable
{
    /**
     * @param  array  $input
     *
     * @return Builder
     */
    public function get($input = [])
    {
        $query = Invoice::whereHas('patient.user')->with(['patient.user'])->select('invoices.*');

        $query->when(isset($input['status']) && $input['status'] != Invoice::STATUS_ALL,
            function (Builder $q) use ($input) {
                $q->where('status', $input['status']);
            });

        /** @var User $user */
        $user = Auth::user();
        if ($user->hasRole('Patient')) {
            $query->where('patient_id', $user->owner_id);
        }

        return $query;
    }
}
