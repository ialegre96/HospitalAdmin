<?php

namespace App\Queries;

use App\Models\Subscription;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class TransactionDataTable
 */
class TransactionDataTable
{
    /**
     * @param  array  $input
     *
     * @return Subscription
     */
    public function get($input = [])
    {
        /** @var Transaction $ery */
        $query = Transaction::with(['transactionSubscription.subscriptionPlan', 'user'])->select('transactions.*');

        if (getLoggedInUser()->hasRole('Admin')) {
            $query->where('user_id', '=', getLoggedInUserId());
        }

        $query->when(isset($input['payment_type']),
            function (Builder $q) use ($input) {
                $q->where('payment_type', $input['payment_type']);
            });

        return $query;
    }
}
