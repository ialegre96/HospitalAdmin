<?php

namespace App\Queries;

use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class UserDataTable
 */
class HospitalTransactionDataTable
{
    /**
     * @param  array  $input
     *
     * @return User
     */
    public function get($input = [])
    {
        $hospital = User::with('roles')->findOrFail($input['id']);
        /** @var User $query */
        $query = Transaction::with(['transactionSubscription.subscriptionPlan'])->where('user_id',
            $hospital->id)->select('transactions.*');

        $query->when(isset($input['payment_type']) && $input['payment_type'] != Transaction::PAYMENT_TYPES,
            function (Builder $q) use ($input) {
                $q->where('payment_type', $input['payment_type']);
            });

        return $query;
    }
}
