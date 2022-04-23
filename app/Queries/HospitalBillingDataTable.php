<?php

namespace App\Queries;

use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class UserDataTable
 */
class HospitalBillingDataTable
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
        $query = Subscription::with(['subscriptionPlan', 'transactions'])->where('user_id',
            $hospital->id)->select('subscriptions.*');

        $query->when(isset($input['status']) && $input['status'] != User::STATUS_ARR,
            function (Builder $q) use ($input) {
                $q->where('status', $input['status']);
            });

        $query->when(isset($input['payment_type']) && $input['payment_type'] != Transaction::PAYMENT_TYPES,
            function (Builder $q) use ($input) {
                $q->whereHas('transactions', function ($q) use ($input) {
                    $q->where('payment_type', '=', $input['payment_type']);
                });
            });

        return $query;
    }
}
