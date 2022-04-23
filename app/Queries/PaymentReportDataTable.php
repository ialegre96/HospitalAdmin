<?php

namespace App\Queries;

use App\Models\Account;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class PaymentReportDataTable
 */
class PaymentReportDataTable
{
    /**
     * @param  array  $input
     *
     * @return Payment
     */
    public function get($input = [])
    {
        /** @var Payment $query */
        $query = Payment::with('accounts')->select('payments.*');

        $query->when(isset($input['account_type']) && $input['account_type'] != Account::TYPE_ALL,
            function (Builder $q) use ($input) {
                $q->whereHas('accounts', function ($q) use ($input) {
                    $q->where('type', '=', $input['account_type']);
                });
            });

        return $query;
    }
}
